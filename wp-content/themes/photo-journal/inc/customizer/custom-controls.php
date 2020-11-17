<?php
/**
 * Custom Controls
 *
 * @package Photo_Journal
 */

/**
 * Add Custom Controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_journal_custom_controls( $wp_customize ) {
	// Custom control for Important Links.
	class Photo_Journal_Important_Links_Control extends WP_Customize_Control {
		public $type = 'important-links';

		public function render_content() {
			// Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links.
			$important_links = array(
				'theme_instructions' => array(
					'link'  => esc_url( 'https://catchthemes.com/themes/photo-journal/#theme-instructions' ),
					'text'  => esc_html__( 'Theme Instructions', 'photo-journal' ),
					),
				'support' => array(
					'link'  => esc_url( 'https://catchthemes.com/support/' ),
					'text'  => esc_html__( 'Support', 'photo-journal' ),
					),
				'changelog' => array(
					'link'  => esc_url( 'https://catchthemes.com/themes/photo-journal/#changelog' ),
					'text'  => esc_html__( 'Changelog', 'photo-journal' ),
					),
				'facebook' => array(
					'link'  => esc_url( 'https://www.facebook.com/catchthemes/' ),
					'text'  => esc_html__( 'Facebook', 'photo-journal' ),
					),
				'twitter' => array(
					'link'  => esc_url( 'https://twitter.com/catchthemes/' ),
					'text'  => esc_html__( 'Twitter', 'photo-journal' ),
					),
				'pinterest' => array(
					'link'  => esc_url( 'http://www.pinterest.com/catchthemes/' ),
					'text'  => esc_html__( 'Pinterest', 'photo-journal' ),
					),
			);

			foreach ( $important_links as $important_link ) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . $important_link['text'] . ' </a></p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
			}
		}
	}

	// Custom control for dropdown category multiple select.
	class Photo_Journal_Multi_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-categories';

		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'             => $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => false,
					'hide_if_empty'    => false,
					'show_option_all'  => esc_html__( 'All Categories', 'photo-journal' ),
				)
			);

			$dropdown = str_replace( '<select', '<select multiple = "multiple" style = "height:150px;" ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',esc_html( $this->label ), $dropdown ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
			echo '<p class="description">' . esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'photo-journal' ) . '</p>';
		}
	}

	// Custom control for any note, use label as output description.
	class Photo_Journal_Note_Control extends WP_Customize_Control {
		public $type = 'description';

		public function render_content() {
			echo '<h2 class="description">' . $this->label . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
		}
	}

	class Photo_Journal_Toggle_Control extends WP_Customize_Control {
		public $type = 'light';

		/**
		 * Render the control's content.
		 */
		public function render_content() {
			?>
			<label>
				<div style="display:flex;flex-direction: row;justify-content: flex-start;">
					<span class="customize-control-title" style="flex: 2 0 0; vertical-align: middle;"><?php echo esc_html( $this->label ); ?></span>
					<input id="cb<?php echo esc_attr( $this->instance_number ); ?>" type="checkbox" class="tgl tgl-<?php echo $this->type; ?>" value="<?php echo esc_attr( $this->value() ); ?>"
											<?php
											$this->link();
											checked( $this->value() );
											?>
					 />
					<label for="cb<?php echo $this->instance_number; ?>" class="tgl-btn"></label>
				</div>
				<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>
			</label>
			<?php
		}
		/**
		 * Plugin / theme agnostic path to URL
		 *
		 * @see https://wordpress.stackexchange.com/a/264870/14546
		 * @param string $path  file path
		 * @return string       URL
		 */
		private function abs_path_to_url( $path = '' ) {
			$url = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
			return esc_url_raw( $url );
		}
	}
}
add_action( 'customize_register', 'photo_journal_custom_controls', 1 );
