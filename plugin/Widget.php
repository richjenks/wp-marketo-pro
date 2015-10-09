<?php namespace RichJenks\WPMarketoPro;

/**
 * Widget to embed a form
 */
class Widget extends \WP_Widget {

	/**
	 * Register widget
	 */
	public function __construct() {
		parent::__construct(
			'marketo_form_widget', // Base ID
			__( 'Marketo Form', 'marketo_pro' ), // Name
			[ 'description' => __( 'Show a Marketo Form', 'marketo_pro' ) ]
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		$form = new Form( [ 'id' => $instance['form_id'] ], null );
		echo $form->output();
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title   = ! empty( $instance['title'] )   ? $instance['title']   : '';
		$form_id = ! empty( $instance['form_id'] ) ? $instance['form_id'] : '';
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		<label for="<?php echo $this->get_field_id( 'form_id' ); ?>"><?php _e( 'Form ID:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'form_id' ); ?>" name="<?php echo $this->get_field_name( 'form_id' ); ?>" type="number" value="<?php echo esc_attr( $form_id ); ?>" step="1" min="1">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['form_id'] = ( ! empty( $new_instance['form_id'] ) ) ? strip_tags( $new_instance['form_id'] ) : '';

		return $instance;
	}

}