<?php
	class Olsen_Light_Onboarding_Page_Lite extends Olsen_Light_Onboarding_Page {
		/**
		 * Populate the support tab
		 *
		 * @return void
		 */
		public function upgrade_pro() {
			?>
			<h3><?php echo wp_kses( __( 'Did you know there is a <strong>pro</strong> version?', 'olsen-light' ), olsen_light_get_allowed_tags() ); ?></h3>
			<div class="three-col">
				<table class="olsen-light-onboarding-table">
					<tr>
						<th class="olsen-light-onboarding-feature"></th>
						<th class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'Light', 'olsen-light' ); ?></th>
						<th class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Pro', 'olsen-light' ); ?></th>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Responsive Layout', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Documentation', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Upload Your Own Logo', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Social Networking Options', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Page Builder Support', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Translation Ready', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'WooCommerce Support', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Multiple Layouts', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Color Customization Options', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Typography Customization Options', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Post/Page Element Visibility Options', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Post Greeting Options', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Post Formats', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Author Box', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Sticky Navigation', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"><?php esc_html_e( 'Priority Support', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"><?php esc_html_e( 'No', 'olsen-light' ); ?></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-pro"><?php esc_html_e( 'Yes', 'olsen-light' ); ?></td>
					</tr>
					<tr>
						<td class="olsen-light-onboarding-feature"></td>
						<td class="olsen-light-onboarding-col olsen-light-onboarding-lite"></td>
						<td class="olsen-light-onboarding-col">
							<a href="https://www.cssigniter.com/themes/olsen/" class="button button-primary button-action" target="_blank"><?php esc_html_e( 'Upgrade Today!', 'olsen-light' ); ?></a>
						</td>
					</tr>
				</table>
			</div>
			<?php
		}
	}

