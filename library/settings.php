<?php
/**
 * Settings management panel for the plugin. The user set options are processed over here.
 * @package WordPress
 * @subpackage CSMM
 * @since 0.1
 */

function csSignalsAdminSettings() {

	// Including the MailChimp class.
	include ('API/class.MailChimp.php');

	// List of Google fonts.
	include ('fonts.php');

	// Saving (updating) options over here.
	if (isset ($_POST['signals_CSMM_submit'])) {
		// Checking whether the status option is checked or not.
		if (isset ($_POST['signals_CSMM_status'])) {
			$signals_csmm_status = absint ($_POST['signals_CSMM_status']);
		} else {
			$signals_csmm_status = 2;
		}

		// Checking whether the disable plugin option is checked or not.
		if (isset ($_POST['signals_CSMM_disable'])) {
			$signals_csmm_disable = absint ($_POST['signals_CSMM_disable']);
		} else {
			$signals_csmm_disable = 2;
		}

		// Checking whether the user logged in option is checked or not.
		if (isset ($_POST['signals_CSMM_showLogged'])) {
			$signals_csmm_logged = absint ($_POST['signals_CSMM_showLogged']);
		} else {
			$signals_csmm_logged = 2;
		}

		// Checking whether the search engine exclusion option is checked or not.
		if (isset ($_POST['signals_CSMM_excludeSE'])) {
			$signals_csmm_exclude = absint ($_POST['signals_CSMM_excludeSE']);
		} else {
			$signals_csmm_exclude = 2;
		}

		// Checking whether the ignore template style option is checked or not.
		if (isset ($_POST['signals_CSMM_ignoreStyle'])) {
			$signals_csmm_ignore = absint ($_POST['signals_CSMM_ignoreStyle']);
		} else {
			$signals_csmm_ignore = 2;
		}

		// For the MailChimp list ID.
		if (isset ($_POST['signals_CSMM_list'])) {
			$signals_csmm_list = csSignalsCleanInput ($_POST['signals_CSMM_list']);
		} else {
			$signals_csmm_list = '';
		}

		// Not sanitizing the HTML and CSS provided by the admin.
		// Giving full freedom to them :)
		$signals_csmm_html 	= $_POST['signals_CSMM_html'];
		$signals_csmm_css 	= $_POST['signals_CSMM_css'];


		// Saving the record to the database.
		$signals_csmm_options = array (
			'status'				=> $signals_csmm_status,
			'template' 				=> csSignalsCleanInput ($_POST['signals_CSMM_template']),
			'title' 				=> csSignalsCleanInput ($_POST['signals_CSMM_title']),
			'header_text' 			=> csSignalsCleanInput ($_POST['signals_CSMM_header']),
			'secondary_text' 		=> csSignalsCleanInput ($_POST['signals_CSMM_secondary']),
			'show_logged_in' 		=> $signals_csmm_logged,
			'custom_login_url' 		=> csSignalsCleanInput ($_POST['signals_CSMM_custom_login']),
			'exclude_se'			=> $signals_csmm_exclude,
			'mailchimp_api'			=> csSignalsCleanInput ($_POST['signals_CSMM_api']),
			'mailchimp_list' 		=> $signals_csmm_list,
			'ignore_template'		=> $signals_csmm_ignore,
			'bg_cover' 				=> csSignalsCleanInput ($_POST['signals_CSMM_bg']),
			'bg_color' 				=> csSignalsCleanInput ($_POST['signals_CSMM_color']),
			'header_font' 			=> csSignalsCleanInput ($_POST['signals_CSMM_header_font']),
			'header_font_size' 		=> csSignalsCleanInput ($_POST['signals_CSMM_header_size']),
			'header_font_color' 	=> csSignalsCleanInput ($_POST['signals_CSMM_header_color']),
			'secondary_font' 		=> csSignalsCleanInput ($_POST['signals_CSMM_secondary_font']),
			'secondary_font_size' 	=> csSignalsCleanInput ($_POST['signals_CSMM_secondary_size']),
			'secondary_font_color' 	=> csSignalsCleanInput ($_POST['signals_CSMM_secondary_color']),
			'disable_settings' 		=> $signals_csmm_disable,
			'custom_html'			=> $signals_csmm_html,
			'custom_css'			=> $signals_csmm_css
		);

		// Updating the options in the database and showing message to the user.
		update_option ('signals_csmm_options', $signals_csmm_options);
		$signals_csmm_err = '<div class="Signals_Alert Signals_Alert_Info"><strong>Hey!</strong> Options have been updated.</div>';
	}

	// Grabbing admin_email from the database.
	$signals_admin_email  = get_option ('admin_email', '');

	// Panel for the plugin page in the backend.
	include ('views/panel.php');

}

// AJAX request for user support.
function csSignalsSupport() {

	// We are going to store the response in the $response() array.
	$response = array (
		'code' 		=> 'error',
		'response' 	=> 'Please fill in both the fields to create your support ticket.'
	);

	if (!empty ($_POST['signals_support_email']) && !empty ($_POST['signals_support_issue'])) {
		// Filtering and sanitizing the support issue.
		$admin_email 	= csSignalsCleanInput ($_POST['signals_support_email']);
		$issue 			= $_POST['signals_support_issue'];

		$subject 	= '[Support Ticket] by '. $admin_email;
		$body 		= "Email: $admin_email \r\nIssue: $issue";
		$headers 	= 'From: ' . $admin_email . "\r\n" . 'Reply-To: ' . $admin_email;

		// Sending the mail to the support email.
		if (TRUE === wp_mail ('support@69signals.com', $subject, $body, $headers)) {
			// Sending the success response.
			$response = array (
				'code' 		=> 'success',
				'response' 	=> 'We have received your support ticket. We will get back to you shortly!'
			);
		} else {
			// Sending the failure response.
			$response = array (
				'code' 		=> 'error',
				'response' 	=> 'There was an error creating the support ticket. You can try again later or send us an email directly to <strong>support@69signals.com</strong>'
			);
		}
	}

	// Sending proper headers and sending the response back in the JSON format.
	header ("Content-Type: application/json");
	echo json_encode ($response);

	// Exiting the AJAX function. This is always required.
	exit();

}

add_action ('wp_ajax_signals_support', 'csSignalsSupport');