<?php
/**
 * Social Icons Widget
 *
 * @package Photo_Journal
 */


/**
 * Adds Social Icons widget.
 *
 * @since Photo Journal 0.1
 */
class Photo_Journal_Social_Icons_Widget extends WP_Widget {
	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		$this->defaults = array(
			'title'			=> '',
			'content'		=> '',
			'contentformat'	=> 1
		);

		$widget_ops = array(
			'classname'   => 'ct-social-widget ctsocialwidget',
			'description' => esc_html__( 'Use this widget to add short information and Social Menu', 'photo-journal' ),
		);

		$control_ops = array(
			'id_base' => 'ct-social',
		);

		parent::__construct(
			'ct-social', // Base ID
			__( 'CT: Social Icons', 'photo-journal' ), // Name
			$widget_ops,
			$control_ops
		);
	}

	public function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		$nav_menu_args = array(
			'fallback_cb' => '',
			'menu_class'  => 'social-links-menu',
			'depth'       => 1,
			'link_before' => '<span class="screen-reader-text">',
			'link_after'  => '</span>' . photo_journal_get_svg( array( 'icon' => 'chain' ) ),
			'menu'        => $nav_menu
		);

		/**
		 * Filter the arguments for the Custom Menu widget.
		 *
		 * @since 4.2.0
		 *
		 * @param array    $nav_menu_args {
		 *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
		 *
		 *     @type callback|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
		 *     @type mixed         $menu        Menu ID, slug, or name.
		 * }
		 * @param stdClass $nav_menu      Nav menu object for the current menu.
		 * @param array    $args          Display arguments for the current widget.
		 */
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args ) );

		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.', 'photo-journal' ), esc_url( admin_url('nav-menus.php') ) ) . '</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'photo-journal' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('nav_menu') ); ?>"><?php esc_html_e( 'Select Menu:', 'photo-journal' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('nav_menu') ); ?>" name="<?php echo esc_attr( $this->get_field_name('nav_menu') ); ?>">
				<option value="0"><?php esc_html_e( '-- Select --', 'photo-journal' ); ?></option>
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. esc_html( $menu->name ) . '</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}

/**
 * Initialize Social Icons Widget
 */
function photo_journal_social_icons_init() {
	register_widget( 'Photo_Journal_Social_Icons_Widget' );
}
add_action( 'widgets_init', 'photo_journal_social_icons_init' );
