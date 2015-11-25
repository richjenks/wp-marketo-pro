<?php namespace RichJenks\WPMarketoPro;

/**
 * Embed a form or output a lightbox link
 * Primarily for use as a shortcode but can be called from anywhere
 */
class Form {

	/**
	 * @var array Shortcode attributes
	 */
	private $atts;

	/**
	 * @var string Shortcode content
	 */
	private $content;

	/**
	 * Sanitizes and stores shortcode attributes
	 *
	 * @param array $atts User-provided attributes
	 */
	public function __construct( $atts, $content ) {

		// Enqueue script for forms
		wp_enqueue_script( 'marketopro-forms-v2' );

		// Sanitize atts and content
		$this->atts = shortcode_atts( [
			'id'       => false,
			'tag'      => 'a',
			'class'    => '',
			'lightbox' => false,
			'success'  => false,
		], $atts, 'form' );

		// Set non-configurable options
		$this->atts['html_id']  = substr( hash( 'sha256', microtime() ), 0, 8 );
		$this->atts['marketo']  = get_option('marketo_pro_marketo_id');
		$this->atts['munchkin'] = get_option('marketo_pro_munchkin_id');

		// Allow shortcodes in content
		$this->content  = do_shortcode( $content );

		// Filter atts and content
		$this->atts    = apply_filters( 'marketo_pro_atts', $this->atts );
		$this->content = apply_filters( 'marketo_pro_content', $this->content );

	}

	/**
	 * Constructs and outputs HTML for shortcode
	 *
	 * @return string Shortcode HTML
	 */
	public function output() {

		// Add params to global
		global $marketo_pro_forms;
		$marketo_pro_forms[] = [
			'formId'   => $this->atts['id'],
			'htmlId'   => $this->atts['html_id'],
			'lightbox' => $this->atts['lightbox'],
			'success'  => $this->atts['success'],
		];

		// Localize script with form variables
		add_action( 'wp_footer', [ $this, 'localize' ] );

		// Enqueue script that gets localized later
		wp_enqueue_script( 'marketopro-form' );

		// Before form
		do_action( 'marketo_pro_before_form' );

		// Output form in correct place
		$html = sprintf( '<form id="mktoForm_%s"></form>', $this->atts['id'] );
		if ( $this->atts['lightbox'] ) {

			// Form is lightbox, so output form in footer and link here
			add_action( 'wp_footer', function () use ( $html ) { echo $html; } );
			return $this->element( $this->atts['tag'], $this->content, [
				'id'    => $this->atts['html_id'],
				'class' => $this->atts['class'],
			] );

		} else {

			// Form is embedded, so output form here
			return $html;

		}

		// After form
		do_action( 'marketo_pro_after_form' );

	}

	/**
	 * Constructs an enclosing HTML element
	 *
	 * @param string $tag        HTML element
	 * @param string $content    HTML inner content
	 * @param array  $attributes HTML attributes and values
	 *
	 * @return string Full HTML element
	 */
	private function element( $tag, $content, $attributes ) {
		if ( $tag === 'a' ) $attributes[ 'href' ] = '#';
		$atts = '';
		foreach ($attributes as $key => $value) $atts .= sprintf( ' %s="%s"', $key, $value );
		return sprintf( '<%1$s%2$s>%3$s</%1$s>', $tag, $atts, $content );
	}

	/**
	 * Outputs script for form at `wp_footer`
	 * Only runs once!
	 */
	public function localize() {

		global $marketo_pro_forms;
		global $marketo_pro_forms_localized;

		/**
		 * Function is called for each form
		 * so only localize if it hasn't already happened!
		 */
		if ( empty( $marketo_pro_forms_localized ) ) {
			$data = [
				'marketoId'  => $this->atts['marketo'],
				'munchkinId' => $this->atts['munchkin'],
				'forms'      => $marketo_pro_forms,
				'defaults'   => $this->defaults($_GET),
			];
			wp_localize_script( 'marketopro-form', 'MarketoProForm', $data );
			$marketo_pro_forms_localized = true;
		}

	}

	/**
	 * Gets field names and default values from whitelisted query strings
	 * Only returns a field if it's whitelisted and actually provided
	 *
	 * @param  array $get $_GET superglobal
	 * @return array Field IDs and values
	 */
	private function defaults( $get ) {
		$fields = [];
		$whitelist = explode( '|', get_option( 'marketo_pro_query_strings', '' ) );
		foreach ($whitelist as $option) {
			$e             = explode( ':', $option );
			$id            = $e[1];
			$key           = $e[0];
			$value         = $_GET[ $e[0] ];
			if ( !empty( $value ) ) $fields[ $id ] = $value;
		}
		return $fields;
	}

}