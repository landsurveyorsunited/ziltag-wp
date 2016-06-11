<?php
/*
Plugin Name: Ziltag Plugin
Plugin URI: http://wordpress.org/plugins/ziltag-plugin/
Description: Ziltag is a visual tagging plugin that helps you discover and discuss wonderful things. By directly connecting users to everything on images, we make information more accessible and shareable.
Author: Ziltag
Version: 1.0
Author URI: http://ziltag.com/
*/

add_action( 'admin_menu', 'ziltag_add_admin_menu' );
add_action( 'admin_init', 'ziltag_settings_init' );
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );


function ziltag_add_admin_menu(  ) {
	add_options_page( 'Ziltag Plugin Setting', 'Ziltag', 'manage_options', 'ziltag-plugin', 'ziltag_options_page');
}


function ziltag_settings_init(  ) {

	register_setting( 'pluginPage', 'ziltag_settings' );

	add_settings_section(
		'ziltag_pluginPage_section',
		'Ziltag Plugin Setting',
		'ziltag_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'ziltag_text_field_0',
		'plugin token',
		'ziltag_text_field_0_render',
		'pluginPage',
		'ziltag_pluginPage_section'
	);
}


function ziltag_text_field_0_render(  ) {

	$options = get_option( 'ziltag_settings' );
	?>
	<input maxlength='6' minlength='6' size='6' type='text' name='ziltag_settings[ziltag_text_field_0]' value='<?php echo $options['ziltag_text_field_0']; ?>'>
	<?php

}


function ziltag_settings_section_callback() {
	?>
	<p>
		You can check your plugin token in <a href="https://ziltag.com/dashboard/account">Ziltag Dashboard</a>,
		it's 6 letter long, composed of digits and letters.
	</p>
	<p>For example, if this is your plugin script:</p>
	<code>&lt;script src=&quot;https://ziltag.com/plugin.js&quot; data-ziltag=&quot;596be5&quot;&gt;&lt;/script&gt;</code>
	<p>Then your token will be <code>596be5</code>.</p>
	<?php
}


function ziltag_options_page(  ) {

	?>
	<form action='options.php' method='post'>
		<?php
		settings_fields('pluginPage');
		do_settings_sections('pluginPage');
		submit_button();
		?>

	</form>
	<?php

}

function add_action_links( $links ){
	$mylinks = array(
		'<a href="' . admin_url('options-general.php?page=ziltag-plugin' ) . '">Settings</a>',
	);
	return array_merge($mylinks, $links);
}

?>