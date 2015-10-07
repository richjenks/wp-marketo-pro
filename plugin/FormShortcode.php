<?php namespace RichJenks\WPMarketoPro;

class FormShortcode {

	/**
	 * @var array Shortcode attributes
	 */
	private $atts;

	/**
	 * @var string Shortcode content
	 */
	private $content;

	/**
	 * @var bool Whether the form is a lightbox
	 */
	private $lightbox;

	/**
	 * @var string ID for HTML elements
	 */
	private $html_id;

	/**
	 * Sanitizes and stores shortcode attributes
	 *
	 * @param array $atts User-provided attributes
	 */
	public function __construct( $atts, $content ) {

		// Enqueue script for forms
		wp_enqueue_script( 'marketopro-forms2' );

		// Sanitize atts
		$this->atts = shortcode_atts( [
			'id'       => false,
			'tag'      => 'a',
			'class'    => '',
			'html_id'  => substr( hash( 'sha256', microtime() ), 0, 8 ),
			'marketo'  => get_option('marketo_pro_marketo_id'),
			'munchkin' => get_option('marketo_pro_munchkin_id'),
		], $atts, 'form' );

		// Embed or show lightbox link?
		$this->content  = $content;
		$this->lightbox = ( empty( $content ) ) ? false : true;

	}

	/**
	 * When execution ends, localize script
	 */
	public function __destruct() {
		global $marketoproforms;
		$data = [
			'marketoId'  => $this->atts['marketo'],
			'munchkinId' => $this->atts['munchkin'],
			'forms'      => $marketoproforms,
		];
		wp_localize_script( 'marketopro-form', 'MarketoPro', $data );
	}

	/**
	 * Constructs and outputs HTML for shortcode
	 *
	 * @return string Shortcode HTML
	 */
	public function output() {

		// Add params to global
		global $marketoproforms;
		$marketoproforms[] = [
			'formId'     => $this->atts['id'],
			'htmlId'     => $this->atts['html_id'],
			'lightbox'   => $this->lightbox,
		];

		// Enqueue script that gets localized later
		wp_enqueue_script( 'marketopro-form' );

		// Output form in correct place
		$html = sprintf( '<form id="mktoForm_%s"></form>', $this->atts['id'] );
		if ( $this->lightbox ) {

			// Form is lightbox, so output form in footer and link here
			add_action( 'wp_footer', function () use ( $html ) {
				echo $html;
			} );
			return $this->element( $this->atts['tag'], $this->content, [
				'id'    => $this->atts['html_id'],
				'class' => $this->atts['class'],
			] );

		} else {

			// Form is embedded, so output form here
			return $html;

		}

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
		foreach ($attributes as $key => $value) $atts .= sprintf( ' %s="%s"', $key, $value );
		return sprintf( '<%1$s%2$s>%3$s</%1$s>', $tag, $atts, $content );
	}

}