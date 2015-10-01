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
	 * Sanitizes and stores shortcode attributes
	 *
	 * @param array $atts User-provided attributes
	 */
	public function __construct( $atts, $content = null ) {
		var_dump( $atts );
		var_dump( $content );
		$this->content = $content;
		$this->atts = shortcode_atts( [
			'id'       => false,
			'tag'      => 'a',
			'class'    => '',
			'marketo'  => get_option('marketo_pro_marketo_id'),
			'munchkin' => get_option('marketo_pro_munchkin_id'),
		], $atts, 'form' );
	}

	/**
	 * Constructs and outputs HTML for shortcode
	 *
	 * @return string Shortcode HTML
	 */
	public function output() {
		$type = ( empty( $this->content ) ) ? 'form' : 'lightbox';
		$js = file_get_contents( __DIR__ . '/../assets/' . $type . '.js' );

		$js = str_replace( '[form_id]',     $this->atts['id'],       $js );
		$js = str_replace( '[marketo_id]',  $this->atts['marketo'],  $js );
		$js = str_replace( '[munchkin_id]', $this->atts['munchkin'], $js );

		return $js;
	}
}