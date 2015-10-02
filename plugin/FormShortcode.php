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

		// Enqueue form script
		wp_enqueue_script( 'marketoforms2' );

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
		$this->content = $content;
		$this->lightbox = ( empty( $content ) ) ? false : true;

	}

	/**
	 * Constructs and outputs HTML for shortcode
	 *
	 * @return string Shortcode HTML
	 */
	public function output() {
		if ( $this->lightbox )
			return $this->content;
			else return 'FORM';
	}

	private function element( $tag, $content, $attributes ) {
		if ( $tag === 'a' ) $attributes[ 'href' ] = '#';

		$element = '<' . $tag;
		foreach ( $attributes as $attribute => $value ) {
			$element .= ' ' . $attribute . '="' . $value . '"';
		}
		$element .= '>';
		$element .= $content;
		$element .= '</' . $tag . '>';

		return $element;
	}

}