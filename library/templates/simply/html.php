<?php
/**
 * Settings management panel for the plugin. The user set options are processed over here.
 * Template: Simply
 *
 * @package WordPress
 * @subpackage CSMM
 * @since 0.1
 * @version 0.1
 *
 * Assigning values if the stored values are empty.
 * Starting with page title.
 */
if ('' == $signals_csmm_options['title']) {
	$signals_csmm_options['title'] = __('Maintainance Mode', 'signals');
}

// Header Text
if ('' == $signals_csmm_options['header_text']) {
	$signals_csmm_options['header_text'] = __('Maintainance Mode.', 'signals');
}

if ('' == $signals_csmm_options['secondary_text']) {
	$signals_csmm_options['secondary_text'] = __('We are performing scheduled maintenance task on our servers because of which the website will be unavailable. In the meantime, you can subscribe to our mailing list and get notified about our important events.', 'signals');
}

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1, minimum-scale=1, width=device-width" />
<title><?php echo $signals_csmm_options['title']; ?></title>
<?php

	// Checking whether custom styles are applied or not.
	if (1 == $signals_csmm_options['ignore_template']) {

?>
<script src='//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js'></script>
<script>
	WebFont.load({
		google: {
			families: ['<?php echo $signals_csmm_options["header_font"]; ?>', '<?php echo $signals_csmm_options["secondary_font"]; ?>']
		}
	});
</script>
<?php

	}

?>
<link rel="stylesheet" type="text/css" href="<?php echo SIGNALS_CSMM_URL; ?>/content/css/front.css" />
<style type="text/css">
body { background-color: #ffffff; }
<?php

	/**
	 * Custom styles for the page.
	 * Checking whether custom styles are applied or not.
	 * "/r/n" is used for the line breaks.
	 */
	if (2 == $signals_csmm_options['disable_settings']) {
		if (1 == $signals_csmm_options['ignore_template']) {
			// Applying custom styles to the header text.
			echo 'body { background-color: #' . $signals_csmm_options['bg_color'] . ' !important }' . "\r\n";

			// Applying custom styles to the header text.
			echo 'h1 { font-family: "' . $signals_csmm_options['header_font'] . '", sans-serif !important; font-size: ' . $signals_csmm_options['header_font_size'] . 'px !important; color: #' . $signals_csmm_options['header_font_color'] . ' !important }' . "\r\n";

			// Applying custom styles to the secondary text.
			echo 'p { font-family: "' . $signals_csmm_options['secondary_font'] . '", sans-serif !important; font-size: ' . $signals_csmm_options['secondary_font_size'] . 'px !important; color: #' . $signals_csmm_options['secondary_font_color'] . ' !important }' . "\r\n";
		}
	}

	// Showing the custom CSS over here.
	if (!empty ($signals_csmm_options['custom_css'])) {
		// .CSS for the page.
		echo $signals_csmm_options['custom_css'] . "\r\n";
	}

?>
</style>
</head>
<body>
<div id="maintenance-mode">
	<div class="simply">

	<?php

		// If the use only custom .CSS and .JS option is enabled, then don't display the HTML below.
		if (2 == $signals_csmm_options['disable_settings']) {

	?>

			<div class="row">
				<div class="small-12 medium-8 medium-offset-2 columns">
					<h1>
						<span><?php echo $signals_csmm_options['header_text']; ?></span>
					</h1>
					<p><?php echo $signals_csmm_options['secondary_text']; ?></p>
				</div>
			</div>

			<?php

				// For the custom html part. Showing it above the form as it makes more sense.
				if (!empty ($signals_csmm_options['custom_html'])) {
					echo '<div class="row">' . "\r\n";
					echo '<div class="small-12 medium-8 medium-offset-2 columns">' . "\r\n";
					echo $signals_csmm_options['custom_html'] . "\r\n";
					echo '</div>' . "\r\n";
					echo '</div>' . "\r\n";
				}

				// Checking for the MailChimp API. If the API and the List ID are present, let's how the form.
				if (!empty ($signals_csmm_options['mailchimp_api']) && !empty ($signals_csmm_options['mailchimp_list'])) {
					// Checking if the form is submitted or not. No AJAX in the free version.
					if (isset ($_POST['signals_email'])) {
						// Do the processing over here.
						$signals_email = csSignalsCleanInput ($_POST['signals_email']);

						if ('' === $signals_email) {
							$signals_msg['code'] 		= 'error';
							$signals_msg['response'] 	= __('Please provide your email address.', 'signals');
						} else {
							$signals_email = filter_var (strtolower (trim ($signals_email)), FILTER_SANITIZE_EMAIL);

							if (strpos ($signals_email, '@')) {
								require_once SIGNALS_CSMM_PATH . '/library/API/class.MailChimp.php';

								$signals_connect 	= new MailChimp ($signals_csmm_options['mailchimp_api']);
								$signals_response 	= $signals_connect->call ('lists/subscribe', array (
									'id'            => $signals_csmm_options['mailchimp_list'],
									'email'         => array ('email' => $signals_email),
									'double_optin'  => FALSE,
									'send_welcome'  => TRUE
								));

								// Showing message as per the response from the MailChimp server.
								if (isset ($signals_response['code']) && 214 !== $signals_response['code']) {
									$signals_msg['code'] 		= 'error';
									$signals_msg['response'] 	= __('Oops! Something went wrong.', 'signals');
								} elseif (isset ($signals_response['code']) && 214 === $signals_response['code']) {
									$signals_msg['code'] 		= 'success';
									$signals_msg['response'] 	= __('You are already subscribed!', 'signals');
								} else {
									$signals_msg['code'] 		= 'success';
									$signals_msg['response'] 	= __('Thank you! We\'ll be in touch!', 'signals');
								}
							} else {
								$signals_msg['code'] 		= 'error';
								$signals_msg['response'] 	= __('Please provide a valid email address.', 'signals');
							}
						}
					}

			?>

					<div class="row">
						<div class="small-12 medium-8 medium-offset-2 columns">
							<?php

								// Showing the error message is its set.
								if (isset ($signals_msg)) {
									echo '<div class="signals-response ' . $signals_msg['code'] . '">' . $signals_msg['response'] . '</div>';
								}

							?>
							<form role="form" method="POST" style="margin: 0">
								<input type="text" name="signals_email" placeholder="<?php _e('Enter your email here'); ?>">
								<button type="submit" class="button small radius"><?php _e('Subscribe Me', 'signals'); ?></button>
							</form>
						</div>
					</div>

					<script src="<?php echo SIGNALS_CSMM_URL; ?>/content/js/front.js"></script>
					<?php

						// If the background cover is available.
						if (!empty ($signals_csmm_options['bg_cover'])) {

					?>

							<script type="text/javascript">
								jQuery(document).ready(function() {
									jQuery.backstretch("<?php echo $signals_csmm_options['bg_cover']; ?>");
								});
							</script>

	<?php

						}
				}
		} else {
			// Displaying only the html part.
			echo $signals_csmm_options['custom_html'];
		}

	?>

	</div>
</div>
</body>
</html>