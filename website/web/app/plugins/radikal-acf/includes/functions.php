<?php
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;


if ( ! function_exists( 'rad_acf_injectACFGroups' ) ) {
	function rad_acf_injectACFGroups(){

		$filePath = plugin_dir_path( __FILE__ ) . 'acf_groups/';
		$targetPath = get_template_directory() . '/acf-json/';

		$files = scandir($filePath);
		foreach($files as $file) {
			if ( strpos($file, '.json') !== FALSE ){
				if ( !file_exists($targetPath . $file)){
					copy($filePath . $file, $targetPath . $file);
				}
			}
		}
	}
}



function __register_routes() {

	register_rest_route( 'roularta/v1', 'newsletter', array(
		'methods' => 'POST',
		'callback' => 'roularta_newsletter',
		'args' => array(),
		'permission_callback' => function () {
			return true;
		}
	));
}
add_action('rest_api_init', __NAMESPACE__ . '\__register_routes');


/**
 * Send this emailaddress to Mailchimp
 * 
 * @return void
 */
require plugin_dir_path( __FILE__ ) . '../../../../../vendor/autoload.php';
use \DrewM\MailChimp\MailChimp;

function roularta_newsletter($request){

	$body = json_decode($request->get_body());
	error_log($body->email);

	//$MailChimp = new MailChimp('e0e71c568d3c3459dde4a1da01845bf5-us9');
	//$result = $MailChimp->get('lists');

	$MailChimp = new MailChimp(MAILCHIMP_TOKEN);
	$list_id = MAILCHIMP_LIST;

	$result = $MailChimp->post("lists/$list_id/members", [
		'email_address' => $body->email,
		'status'        => 'subscribed',
	]);

	print_r($result);

	return ['result' => 'ok' ];
}