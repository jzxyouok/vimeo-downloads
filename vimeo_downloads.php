<?php
/**
 * Vimeo Downloads
 *
 * @package     EastonStudio    
 * @author      Bob Easton
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Vimeo Downloads
 * Plugin URI:  https://www.bob-easton.com/wordpress/vimeo-downloads/
 * Description: A WordPress plugin to collect and display links for downloading Vimeo videos.
 * Version:     0.5
 * Author:      Bob Easton
 * Author URI:  https://bob-easton.com/wordpress
 * Text Domain: vimeo-downloads
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

//namespace EastonStudio;

/*
 * People will be amazed by your success.
 */

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

/* collect settings */
$options = get_option('vd_settings');
	$client_id = $options['vd_client_id'];
	$client_secret = $options['vd_client_secret'];
	$access_token = $options['vd_access_token'];

require_once __DIR__ . '/vimeo/autoload.php';
use Vimeo\Vimeo;
$vimeo = new Vimeo($client_id, $client_secret, $access_token);

function getVideo($videoID) {
	global $vimeo;
	$reply = $vimeo->request('/me/videos/'.$videoID);
	return $reply;
}
	
function by_size($a, $b) {
	return $a['size'] - $b['size'];
}

function switch_label($q) {
	switch ($q) {
		case 'hd':
			$q = 'HD - High Definition';
			break;
		case 'sd':
			$q = 'SD - Standard Definition';
			break;
		case 'mobile':
			$q = ' - Mobile';
			break;	
    default:
			$q = $q ; // should never happen
	}
	return $q ;
}

/* primary function - process a shortcode from a post - return $content */
function vimeo_downloads_shortcode( $atts ) {
	$user_ID = get_current_user_id();
	$video_ID = $atts[video_id];
	if (!empty($video_ID)) {
		$options = get_option('vd_settings');
                $content = $options['vd_preface'];
		$response =  getVideo($video_ID);
                if ($response['body']['error']) {
			$content = 'Uh-Oh! - The download files cannot be found.<br>Please use the <a href="https://www.marymaycarving.com/carvingschool/contact/">Contact form</a> to tell us about this problem.' ;
		} else {
			$count = (count($response['body']['download']));
			// build a new array from the response
			for ($i = 0; $i < $count; $i++) {
				$buttons[$i] = array(
					'quality' => $response['body']['download'][$i]['quality'],
					'link' => $response['body']['download'][$i]['link'],
					'height' => $response['body']['download'][$i]['height'],
					'size' => intval($response['body']['download'][$i]['size'] / 1000000)
					);
			}
			// sort the $buttons array by size ascending
			usort($buttons, 'by_size');	
			
			// prepare the output
			for ($i = 0; $i < $count; $i++) {
				$qual = $buttons[$i]['quality'];
				if ($qual === "source") {
					break;
				}
				// prepare utm parms and then the link and all the rest
				$utm = '&utm_source=vid&utm_medium='.$qual.'&utm_campaign=dl&utm_content='.$user_ID;
				$link = '<a href="' . $buttons[$i]['link'] . $utm . '" rel="nofollow" class="btn btn-primary btn-sm btn-block btn-shortcode element_center">';
				$qual = switch_label($qual);
				$def = $buttons[$i]['height'] . 'p ';
				$size = ' -- Size = ' . $buttons[$i]['size'] . ' MB</a></p>';
				$content = $content . $link . $def . $qual . $size;
			}
		}
	}
	return $content;
}
add_shortcode('vimeo_downloads','vimeo_downloads_shortcode');

/* 
 * options page framework generated by: http://wpsettingsapi.jeroensormani.com/
 *
 */
add_action( 'admin_menu', 'vd_add_admin_menu' );
add_action( 'admin_init', 'vd_settings_init' );

function vd_add_admin_menu(  ) { 
	add_options_page( 'Vimeo Downloads', 'Vimeo Downloads', 'manage_options', 'vimeo_downloads', 'vd_options_page' );
}

function vd_settings_init(  ) { 
	register_setting( 'pluginPage', 'vd_settings' );
	add_settings_section(
		'vd_pluginPage_section', 
		__( 'These settings are used when making queries to Vimeo.<br>Details of their use can be found in the <a href="">Vimeo API documentation</a>.', 'wordpress' ), 
		'vd_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'vd_client_id', 
		__( 'Client Identifier', 'wordpress' ), 
		'vd_client_id_render', 
		'pluginPage', 
		'vd_pluginPage_section' 
	);

	add_settings_field( 
		'vd_client_secret', 
		__( 'Client Secret', 'wordpress' ), 
		'vd_client_secret_render', 
		'pluginPage', 
		'vd_pluginPage_section' 
	);

	add_settings_field( 
		'vd_access_token', 
		__( 'Access Token', 'wordpress' ), 
		'vd_access_token_render', 
		'pluginPage', 
		'vd_pluginPage_section' 
	);

	add_settings_field( 
		'vd_preface', 
		__( 'Text/HTML that precedes the download buttons', 'wordpress' ), 
		'vd_preface_render', 
		'pluginPage', 
		'vd_pluginPage_section' 
	);
}

function vd_client_id_render(  ) { 
	$options = get_option( 'vd_settings' );
	?>
	<input type='text' name='vd_settings[vd_client_id]' value='<?php echo $options['vd_client_id']; ?>'>
	<?php
}

function vd_client_secret_render(  ) { 
	$options = get_option( 'vd_settings' );
	?>
	<input type='text' name='vd_settings[vd_client_secret]' value='<?php echo $options['vd_client_secret']; ?>'>
	<?php
}

function vd_access_token_render(  ) { 
	$options = get_option( 'vd_settings' );
	?>
	<input type='text' name='vd_settings[vd_access_token]' value='<?php echo $options['vd_access_token']; ?>'>
	<?php
}

/* pretty code between the textarea tags add unwanted whitespace to form field rendering */
function vd_preface_render(  ) { 
	$options = get_option( 'vd_settings' );
	?>
	<textarea cols='40' rows='5' name='vd_settings[vd_preface]'><?php echo $options['vd_preface'];?></textarea>
	<?php
}

function vd_settings_section_callback(  ) { 
	echo __( 'Acquire these values from the "<a href="https://developer.vimeo.com/apps">My API Apps" page</a> of your Vimeo Pro account.', 'wordpress' );
}

function vd_options_page(  ) { 
	?>
	<form action='options.php' method='post'>
		<h2>Vimeo Downloads Plugin</h2>
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
	</form>
	<?php
}

?>