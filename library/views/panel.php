<?php
/**
 * Template for the options panel.
 * @package WordPress
 * @subpackage CSMM
 * @since 0.1
 */
?>

<div class="Signals_Cnt_Fix">
	<div class="Signals_Fix_WP38">
		<div class="Signals_Header Signals_Clearfix">
			<img src="<?php echo SIGNALS_CSMM_URL; ?>/content/img/signals-icon.png" class="Signals_Logo">
			<p><strong><?php _e('Minimal Maintenance Mode', 'signals'); ?></strong> <span><?php _e('by', 'signals'); ?> <a href="http://www.69signals.com/" target="_blank"><?php _e('69signals', 'signals'); ?></a></span></p>
		</div>

		<form role="form" method="post" class="Signals_CSMM_Admin_Form">
			<div class="Signals_Body Signals_Clearfix">
				<?php

					// Display the message if $signals_csmm_err is set.
					if (isset ($signals_csmm_err)) {
						echo $signals_csmm_err;
					}

					// Retrieving options for the plugin
					$signals_csmm_options = get_option ('signals_csmm_options');

				?>

				<div class="Signals_Float_Left">
					<div class="Signals_Mobile_Menu">
						<a href="javascript:void;">
							<i class="fa fa-fw fa-bars"></i>
						</a>
					</div>

					<ul class="Signals_Main_Menu">
						<li>
							<a href="#basic"><i class="fa fa-fw fa-sun-o"></i> &nbsp;<?php _e('Basic', 'signals'); ?></a>
						</li>
						<li>
							<a href="#email"><i class="fa fa-fw fa-envelope-o"></i> &nbsp;<?php _e('Email', 'signals'); ?></a>
						</li>
						<li>
							<a href="#design"><i class="fa fa-fw fa-strikethrough"></i> &nbsp;<?php _e('Design', 'signals'); ?></a>
						</li>
						<li>
							<a href="#advanced"><i class="fa fa-fw fa-square"></i> &nbsp;<?php _e('Advanced', 'signals'); ?></a>
						</li>
						<li>
							<a href="#support"><i class="fa fa-fw fa-support"></i> &nbsp;<?php _e('Support', 'signals'); ?></a>
						</li>
						<li>
							<a href="#information"><i class="fa fa-fw fa-info"></i> &nbsp;<?php _e('Information', 'signals'); ?></a>
						</li>
					</ul>
				</div><!-- .Signals_Float_Left -->

				<div class="Signals_Float_Right">
					<div class="Signals_Tile" id="basic">
						<div class="Signals_Tile_Body">
							<div class="Signals_Tile_Title"><?php _e('BASIC', 'signals'); ?></div>
							<p><?php _e('Configure the core settings for the plugin. These are the most important options. So, make sure you configure them carefully.', 'signals'); ?></p>

							<div class="Signals_CSMM_Section_Content">
								<div class="Signals_Form_Group">
									<label for="signals_CSMM_status" class="Signals_CSMM_Strong"><?php _e('Enable Maintenance Mode?', 'signals'); ?></label>
									<input type="checkbox" class="Signals_Form_Ios" name="signals_CSMM_status" value="1"<?php checked ('1', $signals_csmm_options['status']); ?>>

									<p class="Signals_Form_Help_Block"><?php _e('Select the status for the plugin. Do you want to enable Maintenance Mode for your website?', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_template" class="Signals_CSMM_Strong"><?php _e('Select Template', 'signals'); ?></label>

									<select name="signals_CSMM_template" id="signals_CSMM_template" class="Signals_CSMM_Block">
										<option value="simply"<?php selected ($signals_csmm_options['template'], 'simply'); ?>><?php _e('Simply', 'signals'); ?></option>
										<option value="naked"<?php selected ($signals_csmm_options['template'], 'naked'); ?>><?php _e('Naked', 'signals'); ?></option>
										<option value="elegant"<?php selected ($signals_csmm_options['template'], 'elegant'); ?>><?php _e('Elegant', 'signals'); ?></option>
										<option value="black"<?php selected ($signals_csmm_options['template'], 'black'); ?>><?php _e('Black', 'signals'); ?></option>
									</select>

									<p class="Signals_Form_Help_Block"><?php _e('Select the template for the plugin. This is shown to your website visitors when the plugin is activated.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_title" class="Signals_CSMM_Strong"><?php _e('Page Title', 'signals'); ?></label>
									<input type="text" name="signals_CSMM_title" id="signals_CSMM_title" value="<?php echo sanitize_text_field ($signals_csmm_options['title']); ?>" placeholder="<?php _e('Please provide a Page Title', 'signals'); ?>" class="Signals_Form_Control">

									<p class="Signals_Form_Help_Block"><?php _e('Provide title for the maintenance page.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_header" class="Signals_CSMM_Strong"><?php _e('Header Text', 'signals'); ?></label>
									<textarea name="signals_CSMM_header" id="signals_CSMM_header" class="Signals_CSMM_Block" rows="3" placeholder="Header text for the maintenance page"><?php echo esc_textarea ($signals_csmm_options['header_text']); ?></textarea>

									<p class="Signals_Form_Help_Block"><?php _e('Provide header text for the plugin over here. If you leave this blank, default text will be used which is not recommended.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_secondary" class="Signals_CSMM_Strong"><?php _e('Secondary Text', 'signals'); ?></label>
									<textarea name="signals_CSMM_secondary" id="signals_CSMM_secondary" class="Signals_CSMM_Block" rows="3" placeholder="Secondary text for the maintenance page"><?php echo esc_textarea ($signals_csmm_options['secondary_text']); ?></textarea>

									<p class="Signals_Form_Help_Block"><?php _e('Provide secondary text for the plugin over here. If you leave this blank, default text will be used which is not recommended.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_showLogged" class="Signals_CSMM_Strong"><?php _e('Show normal website to logged in users?', 'signals'); ?></label>
									<input type="checkbox" class="Signals_Form_Ios" name="signals_CSMM_showLogged" value="1"<?php checked ('1', $signals_csmm_options['show_logged_in']); ?>>

									<p class="Signals_Form_Help_Block"><?php _e('Enable this option if you want logged in users to view the website normally while visitors see the maintenance page.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_excludeSE" class="Signals_CSMM_Strong"><?php _e('Exclude Search Engines?', 'signals'); ?></label>
									<input type="checkbox" class="Signals_Form_Ios" name="signals_CSMM_excludeSE" value="1"<?php checked ('1', $signals_csmm_options['exclude_se']); ?>>

									<p class="Signals_Form_Help_Block"><?php _e('Do you want to exclude search engines from viewing this plugin? This will enable search engines to view your website rather than the Maintenance Mode page when the plugin is enabled.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_custom_login" class="Signals_CSMM_Strong"><?php _e('Custom login URL', 'signals'); ?></label>
									<input type="text" name="signals_CSMM_custom_login" id="signals_CSMM_custom_login" value="<?php echo sanitize_text_field ($signals_csmm_options['custom_login_url']); ?>" placeholder="<?php _e('Custom login URL', 'signals'); ?>" class="Signals_Form_Control">

									<p class="Signals_Form_Help_Block"><?php _e('In case you are using any plugin for custom login, provide your custom login URL over here. This plugin should be able to detect your custom login automatically in most of the situations. In case it fails to do so, you can provide the custom login URL over here.', 'signals'); ?></p>
								</div>
							</div>
						</div>
					</div><!-- #basic -->

					<div class="Signals_Tile" id="email">
						<div class="Signals_Tile_Body">
							<div class="Signals_Tile_Title"><?php _e('EMAIL', 'signals'); ?></div>
							<p><?php _e('Email settings for the plugin. You can configure your MailChimp account API with this plugin to store collected emails in an list.', 'signals'); ?></p>

							<div class="Signals_CSMM_Section_Content">
								<div class="Signals_Form_Group">
									<label for="signals_CSMM_api" class="Signals_CSMM_Strong"><?php _e('MailChimp API', 'signals'); ?></label>
									<input type="text" name="signals_CSMM_api" id="signals_CSMM_api" value="<?php echo sanitize_text_field ($signals_csmm_options['mailchimp_api']); ?>" placeholder="<?php _e('MailChimp API', 'signals'); ?>" class="Signals_Form_Control">

									<p class="Signals_Form_Help_Block"><?php _e('Provide your MailChimp API over here.', 'signals'); ?> <a href="http://" target="_blank"><?php _e('Click here', 'signals'); ?></a> <?php _e('to know how to get this information. In case you don\'t want to enable subscription option, just leave this field blank.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_list" class="Signals_CSMM_Strong"><?php _e('MailChimp List', 'signals'); ?></label>

									<?php

										// Checking if the API key is present in the database.
										if (!empty ($signals_csmm_options['mailchimp_api'])) {
											// Grabbing lists using the MailChimp API.
											$signals_api 	= new MailChimp ($signals_csmm_options['mailchimp_api']);
											$signals_lists 	= $signals_api->call ('lists/list',
												array (
							                		'apikey' => $signals_csmm_options['mailchimp_api']
							                	)
											);

											if (!$signals_lists) {
												echo '<p class="Signals_Form_Help_Block">' . __('There was an error communicating with the MailChimp server. Please make sure that the API Key used is correct and try again.', 'signals') . '</p>';
											} else if ($signals_lists['total'] == 0) {
												echo '<p class="Signals_Form_Help_Block">' . __('It seems that there is no list created for this account. Why not create one on the MailChimp website and then try here.', 'signals') . '</p>';
											} else {
												echo '<select name="signals_CSMM_list" class="Signals_CSMM_Block" id="signals_CSMM_list">';

												foreach ($signals_lists['data'] as $signals_single_list) {
													echo '<option value="' . $signals_single_list['id'] . '"' . selected ($signals_single_list['id'], $signals_csmm_options['mailchimp_list']) . '>' . $signals_single_list['name'].'</option>';
												}

												echo '</select>';

												echo '<p class="Signals_Form_Help_Block">' . __('Select your MailChimp list in which you would like to store the subscribers data.', 'signals') . '</p>';
											}
										} else {
											echo '<p class="Signals_Form_Help_Block">' . __('Provide your MailChimp API key in the above box and click on `Save Changes` option. Your lists will appear over here.', 'signals') . '</p>';
										}

									?>
								</div>
							</div>
						</div>
					</div><!-- #email -->

					<div class="Signals_Tile" id="design">
						<div class="Signals_Tile_Body">
							<div class="Signals_Tile_Title"><?php _e('DESIGN', 'signals'); ?></div>
							<p><?php _e('Design settings for the plugin. You have the option to modify every aspect of the design so that it matches the look and feel of your website.', 'signals'); ?></p>

							<div class="Signals_CSMM_Section_Content">
								<div class="Signals_Form_Group">
									<label for="signals_CSMM_ignoreStyle" class="Signals_CSMM_Strong"><?php _e('Ignore Default Template Styles', 'signals'); ?></label>
									<input type="checkbox" class="Signals_Form_Ios" name="signals_CSMM_ignoreStyle" value="1"<?php checked ('1', $signals_csmm_options['ignore_template']); ?>>

									<p class="Signals_Form_Help_Block"><?php _e('Turn ON this option if you want to ignore default template styling and use your custom design scheme from below.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_bg" class="Signals_CSMM_Strong"><?php _e('Backgorund Cover Image', 'signals'); ?></label>
									<input type="text" name="signals_CSMM_bg" id="signals_CSMM_bg" value="<?php echo sanitize_text_field ($signals_csmm_options['bg_cover']); ?>" placeholder="<?php _e('Enter an image URL or upload using the button below', 'signals'); ?>" class="Signals_Form_Control">
									<button type="button" name="Signals_Upload_Btn" id="Signals_Upload_Btn" class="Signals_CSMM_Btn" style="margin-top: 4px"><?php _e('Upload Image', 'signals'); ?></button>

									<p class="Signals_Form_Help_Block"><?php _e('Select or upload background cover image for the page.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_color" class="Signals_CSMM_Strong"><?php _e('Backgorund Color', 'signals'); ?></label>
									<input type="text" name="signals_CSMM_color" id="signals_CSMM_color" value="<?php echo sanitize_text_field ($signals_csmm_options['bg_color']); ?>" placeholder="<?php _e('Background color for the page', 'signals'); ?>" class="Signals_Form_Control color">

									<p class="Signals_Form_Help_Block"><?php _e('Select background color for the page. Leave it untouched to use the default layout. If the background cover is set, this option will be ignored.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_header_font" class="Signals_CSMM_Strong"><?php _e('Header Font', 'signals'); ?></label>

									<select name="signals_CSMM_header_font" id="signals_CSMM_header_font" class="Signals_CSMM_Block Signals_Google_Fonts">
										<option value="Arial"><?php _e('Arial', 'signals'); ?></option>
										<option value="Helvetica"><?php _e('Helvetica', 'signals'); ?></option>
										<option value="Georgia"><?php _e('Georgia', 'signals'); ?></option>
										<option value="Times New Roman"><?php _e('Times New Roman', 'signals'); ?></option>
										<option value="Tahoma"><?php _e('Tahoma', 'signals'); ?></option>
										<option value="Verdana"><?php _e('Verdana', 'signals'); ?></option>
										<option value="Geneva"><?php _e('Geneva', 'signals'); ?></option>
										<option disabled>-- via google --</option>
										<?php

											// Listing fonts from the array.
											foreach ($signals_google_fonts as $signals_font) {
												echo '<option value="' . $signals_font . '"' . selected ($signals_font, $signals_csmm_options['header_font']) . '>' . $signals_font . '</option>' . "\n";
											}

										?>
									</select>

									<h3><?php _e('This is how this font is going to look!', 'signals'); ?></h3>

									<p class="Signals_Form_Help_Block"><?php _e('Font for the header text. Listing a total of 668 Google web fonts.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_header_size" class="Signals_CSMM_Strong"><?php _e('Header Font Size', 'signals'); ?></label>

									<select name="signals_CSMM_header_size" id="signals_CSMM_header_size" class="Signals_CSMM_Block">
										<?php

											// Loading font sizes with the help of a loop.
											for ($i = 11; $i < 41; $i++) {
												echo '<option value="' . $i . '"' . selected ($signals_csmm_options['header_font_size'], $i) . '>' . $i . __('px', 'signals') . '</option>';
											}

										?>
									</select>

									<p class="Signals_Form_Help_Block"><?php _e('Font size for the header text. Select the one as per your preference.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_header_color" class="Signals_CSMM_Strong"><?php _e('Header Font Color', 'signals'); ?></label>
									<input type="text" name="signals_CSMM_header_color" id="signals_CSMM_header_color" value="<?php echo sanitize_text_field ($signals_csmm_options['header_font_color']); ?>" placeholder="<?php _e('Font color for the Header text', 'signals'); ?>" class="Signals_Form_Control color">

									<p class="Signals_Form_Help_Block"><?php _e('Select font color for the header text. To use the default colors of the theme, leave it untouched.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_secondary_font" class="Signals_CSMM_Strong"><?php _e('Secondary Font', 'signals'); ?></label>

									<select name="signals_CSMM_secondary_font" id="signals_CSMM_secondary_font" class="Signals_CSMM_Block Signals_Google_Fonts">
										<option value="Arial"><?php _e('Arial', 'signals'); ?></option>
										<option value="Helvetica"><?php _e('Helvetica', 'signals'); ?></option>
										<option value="Georgia"><?php _e('Georgia', 'signals'); ?></option>
										<option value="Times New Roman"><?php _e('Times New Roman', 'signals'); ?></option>
										<option value="Tahoma"><?php _e('Tahoma', 'signals'); ?></option>
										<option value="Verdana"><?php _e('Verdana', 'signals'); ?></option>
										<option value="Geneva"><?php _e('Geneva', 'signals'); ?></option>
										<option disabled>-- via google --</option>
										<?php

											// Listing fonts from the array.
											foreach ($signals_google_fonts as $signals_font) {
												echo '<option value="' . $signals_font . '"' . selected ($signals_font, $signals_csmm_options['secondary_font']) . '>' . $signals_font . '</option>' . "\n";
											}

										?>
									</select>

									<h3><?php _e('This is how this font is going to look!', 'signals'); ?></h3>

									<p class="Signals_Form_Help_Block"><?php _e('Font for the secondary text. Listing a total of 668 Google web fonts.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_secondary_size" class="Signals_CSMM_Strong"><?php _e('Secondary Font Size', 'signals'); ?></label>

									<select name="signals_CSMM_secondary_size" id="signals_CSMM_secondary_size" class="Signals_CSMM_Block">
										<?php

											// Loading font sizes with the help of a loop.
											for ($i = 11; $i < 41; $i++) {
												echo '<option value="' . $i . '"' . selected ($signals_csmm_options['secondary_font_size'], $i) . '>' . $i . __('px', 'signals') . '</option>';
											}

										?>
									</select>

									<p class="Signals_Form_Help_Block"><?php _e('Font size for the secondary text. Select the one as per your preference.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_secondary_color" class="Signals_CSMM_Strong"><?php _e('Secondary Font Color', 'signals'); ?></label>
									<input type="text" name="signals_CSMM_secondary_color" id="signals_CSMM_secondary_color" value="<?php echo sanitize_text_field ($signals_csmm_options['secondary_font_color']); ?>" placeholder="<?php _e('Font color for the Secondary text', 'signals'); ?>" class="Signals_Form_Control color">

									<p class="Signals_Form_Help_Block"><?php _e('Select font color for the secondary text. To use the default colors of the theme, leave it untouched.', 'signals'); ?></p>
								</div>
							</div>
						</div>
					</div><!-- #design -->

					<div class="Signals_Tile" id="advanced">
						<div class="Signals_Tile_Body">
							<div class="Signals_Tile_Title"><?php _e('ADVANCED', 'signals'); ?></div>
							<p><?php _e('You can add custom HTML & CSS in this section. Making wrong changes over here will affect the working of the plugin.', 'signals'); ?></p>

							<div class="Signals_CSMM_Section_Content">
								<div class="Signals_Form_Group">
									<label for="signals_CSMM_disable" class="Signals_CSMM_Strong"><?php _e('Use Custom HTML & CSS only', 'signals'); ?></label>
									<input type="checkbox" class="Signals_Form_Ios" name="signals_CSMM_disable" value="1"<?php checked ('1', $signals_csmm_options['disable_settings']); ?>>

									<p class="Signals_Form_Help_Block"><?php _e('If you enable this option, the plugin will ignore everything except the HTML & CSS you provide. So, use this option carefully.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_html" class="Signals_CSMM_Strong"><?php _e('Custom HTML', 'signals'); ?></label>
									<div id="signals_CSMM_html_editor"></div>
									<textarea name="signals_CSMM_html" id="signals_CSMM_html" class="Signals_CSMM_Block" rows="8" placeholder="Custom HTML for the plugin"><?php echo stripslashes ($signals_csmm_options['custom_html']); ?></textarea>

									<p class="Signals_Form_Help_Block"><?php echo __('Custom HTML for the plugin goes over here. Please note that ', 'signals') . '<i style="color: #f96773">' . __('[html], [head], [title], [meta], [body], and few other tags', 'signals') . '</i>' . __(' are not required. Only provide content HTML for the page.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group">
									<label for="signals_CSMM_disable" class="Signals_CSMM_Strong"><?php _e('Custom CSS', 'signals'); ?></label>
									<div id="signals_CSMM_css_editor"></div>
									<textarea name="signals_CSMM_css" id="signals_CSMM_css" class="Signals_CSMM_Block" rows="8" placeholder="Custom CSS for the plugin"><?php echo stripslashes ($signals_csmm_options['custom_css']); ?></textarea>

									<p class="Signals_Form_Help_Block"><?php _e('Custom CSS for the plugin goes over here.', 'signals'); ?></p>
								</div>
							</div>
						</div>
					</div><!-- #advanced -->

					<div class="Signals_Tile" id="support">
						<div class="Signals_Tile_Body">
							<div class="Signals_Tile_Title"><?php _e('SUPPORT', 'signals'); ?></div>
							<p><?php _e('Getting help is just a click away now. Report issue using the form below and we will get back to you at your admin email address. If the below support form is not working for you, kindly send us an email at ', 'signals'); ?><a href="mailto:support@69signals.com">support@69signals.com</a><?php _e(' explaining the issue you are facing with the plugin.', 'signals'); ?></p>

							<div class="Signals_CSMM_Section_Content Signals_Support_Form">
								<div class="Signals_Ajax_Response"></div>

								<div class="Signals_Form_Group">
									<label for="signals_support_email" class="Signals_CSMM_Strong"><?php _e('Email Address', 'signals'); ?></label>
									<input type="text" name="signals_support_email" id="signals_support_email" value="<?php echo sanitize_text_field ($signals_admin_email); ?>" placeholder="<?php _e('Please provide your email address', 'signals'); ?>" class="Signals_Form_Control">

									<p class="Signals_Form_Help_Block"><?php _e('You will receive support response at this email address.', 'signals'); ?></p>
								</div>

								<div class="Signals_Form_Group" style="border-bottom: none; padding-bottom: 0">
									<label for="signals_support_issue" class="Signals_CSMM_Strong"><?php _e('Issue / Feedback', 'signals'); ?></label>
									<textarea name="signals_support_issue" id="signals_support_issue" class="Signals_CSMM_Block" rows="10" placeholder="Please explain the issue you are facing with the plugin. Provide as much detail as possible."></textarea>

									<p class="Signals_Form_Help_Block"><?php _e('Please explain the issue you are facing with the plugin. Provide as much detail as possible.', 'signals'); ?></p>
								</div>

								<button class="Signals_CSMM_Btn Signals_Create_Ticket"><strong><?php _e('Ask for Support', 'signals'); ?></strong></button>
							</div>
						</div>
					</div><!-- #support -->

					<div class="Signals_Tile" id="information">
						<div class="Signals_Tile_Body">
							<div class="Signals_Tile_Title"><?php _e('INFORMATION', 'signals'); ?></div>
							<p><?php _e('Know more about this plugin, about us and what more we have for you. If you love this plugin, then please like us on social media.', 'signals'); ?></p>

							<div class="Signals_Share_Love Signals_Clearfix">
								<a href="https://twitter.com/akshitsethi" class="twitter-follow-button" data-show-count="false">Follow @akshitsethi</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

								<a href="http://in.linkedin.com/pub/akshit-sethi/16/ab8/68b">
									<img src="https://static.licdn.com/scds/common/u/img/webpromo/btn_viewmy_160x25.png" width="160" height="25" border="0" alt="View Akshit Sethi's profile on LinkedIn">
								</a>

								<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fakshitsethi.me&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=35&amp;appId=568781186516691" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
							</div>

							<?php

								// Getting our latest products and offer from the website.
								$signals_offers = wp_remote_get ('http://www.69signals.com/offers.php?product=csmm');

								// Checking for the errors.
								// If everything is OK, then display the information.
								if (!is_wp_error ($signals_offers)) {
									echo '<div class="Signals_Tile_Title">' . __('OFFERS', 'signals') . '</div>';
									echo $signals_offers['body'] . '<br/>';
								}

							?>

							<div class="Signals_CSMM_Section_Content">
								<div class="Signals_Tile_Title"><?php _e('BLOG', 'signals'); ?></div>
								<p><?php _e('This blog is dedicated to design, coding, jquery, entrepreneurship, and a little bit here & there to make you do stuff the right way.', 'signals'); ?></p>

								<?php

									// Showing feeds from the blog over here.
									wp_widget_rss_output (
										array (
											'url' 			=> 'http://www.akshitsethi.me/feed/',
											'title' 		=> 'Blog Feeds',
											'items' 		=> 4,
											'show_summary' 	=> 0,
											'show_author' 	=> 0,
											'show_date' 	=> 1
										)
									);

								?>
							</div>
						</div>
					</div><!-- #information -->
				</div><!-- .Signals_Float_Right -->
			</div><!-- .Signals_Body -->

			<div class="Signals_Fixed_Save_Btn">
				<div class="Signals_Tile_Body">
					<p class="Signals_Form_Help_Block" style="margin: 0; padding: 0 20px 0 10px"><button type="submit" name="signals_CSMM_submit" class="Signals_CSMM_Btn Signals_Btn_Red"><strong><?php _e('Save Changes', 'signals'); ?></strong></button></p>
				</div>
			</div><!-- .Signals_Fixed_Save_Btn -->

		</form><!-- form.Signals_CSMM_Admin_Form -->
	</div><!-- .Signals_Fix_WP38 -->
</div><!-- .Signals_Cnt_Fix -->

<script src="<?php echo SIGNALS_CSMM_URL; ?>/content/js/switch.js" type="text/javascript"></script>
<script src='//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js'></script>
<script src="<?php echo SIGNALS_CSMM_URL; ?>/content/js/editor/ace.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	var elements = Array.prototype.slice.call(document.querySelectorAll('.Signals_Form_Ios'));
	elements.forEach(function(html) {
		var switchery = new Switchery(html);
	});

	function reloadFont($fontValue) {
		WebFont.load({
		    google: {
		      families: [$fontValue]
		    }
		});
	}

	function changeFont($font) {
		var $fontValue	= $font.val();

		reloadFont($fontValue);
		$font.parent().find('h3').css('font-family', $fontValue);
	}

	function getEditor($editorID, $textareaID, $mode) {
		if (jQuery('#' + $editorID).length > 0) {
			var editor 	= ace.edit($editorID),
			$textarea 	= jQuery('#' + $textareaID).hide();

			editor.getSession().setValue($textarea.val());

			editor.getSession().on('change', function () {
				$textarea.val(editor.getSession().getValue());
			});

			editor.getSession().setMode('ace/mode/' + $mode);
			editor.setTheme('ace/theme/xcode');
			editor.getSession().setUseWrapMode(true);
			editor.getSession().setWrapLimitRange(null, null);
			editor.renderer.setShowPrintMargin(null);

			editor.session.setUseSoftTabs(null);
		}
	}

	getEditor('signals_CSMM_html_editor', 'signals_CSMM_html', 'html');
	getEditor('signals_CSMM_css_editor', 'signals_CSMM_css', 'css');

	jQuery(document).ready(function() {
		jQuery('.Signals_Google_Fonts').each(function() {
			var $font = jQuery(this);
			changeFont($font);
		});

		jQuery(document).on('click', '.Signals_Create_Ticket', function(e) {
		    e.preventDefault();

		    var html = jQuery('.Signals_Ajax_Response');
		    var form = jQuery('.Signals_Support_Form');

		    jQuery.ajax({
		      type: 'POST',
		      url: ajaxurl,
		      data: {signals_support_email: jQuery('#signals_support_email').val(), signals_support_issue: jQuery('#signals_support_issue').val(), action: 'signals_support'},
		      beforeSend: function() {
		        form.block({
		          message: '<center><div class="Signals_CSMM_Strong" style="background: #fefeb8; padding: 6px; color: #000;">Reporting Issue..</div></center>',
		          css: {
		            border: "none",
		            backgroundColor: "none"
		          },
		          overlayCSS: {
		            backgroundColor: "#eee",
		            opacity: "0.5",
		            cursor: "wait"
		          }
		        });
		      }
		    }).done(function(data) {
		      form.unblock();

		      if (data.code == 'success') {
		        html.html('<div class="Signals_Alert Signals_Alert_Info"><strong>Hey!</strong> ' + data.response + '</div>');
		      } else {
		        html.html('<div class="Signals_Alert Signals_Alert_Danger"><strong>Oops!</strong> ' + data.response + '</div>');
		      }
		    });
		});
	});

	jQuery(document).on('change', '.Signals_Google_Fonts', function() {
		var $font = jQuery(this);
		changeFont($font);
	});
</script>