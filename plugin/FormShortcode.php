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
			'html_id'  => uniqid(),
			'marketo'  => get_option('marketo_pro_marketo_id'),
			'munchkin' => get_option('marketo_pro_munchkin_id'),
		], $atts, 'form' );

		// Embed or show lightbox link?
		$this->content  = $content;
		$this->lightbox = ( empty( $content ) ) ? false : true;

	}

	/**
	 * Constructs and outputs HTML for shortcode
	 *
	 * @return string Shortcode HTML
	 */
	public function output() {

		wp_localize_script( 'marketopro-form', 'MarketoPro', [
			'formId'     => $this->atts['id'],
			'htmlId'     => $this->atts['html_id'],
			'marketoId'  => $this->atts['marketo'],
			'munchkinId' => $this->atts['munchkin'],
			'lightbox'   => $this->lightbox,
		] );

		wp_enqueue_script( 'marketopro-form' );

		/**
		 * TRY http://wordpress.stackexchange.com/questions/204765/enqueue-script-multiple-times
		 */

		// if ( $this->lightbox ) {
		// 	return $this->content;
		// } else {
		// 	return 'FORM';
		// }

		// Localise and enqueue script in footer
		// Output form element here for embed
		// Output form element in footer for lighbox

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