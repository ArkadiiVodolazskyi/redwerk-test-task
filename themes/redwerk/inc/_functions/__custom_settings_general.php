<?php

function add_option_field_to_general_admin_page() {
	$option_name = 'email_delay';
	register_setting( 'general', $option_name );

	add_settings_field(
		'email_delay',
		'Затримка відправки email автору оголошення',
		'email_setting_delay_callback',
		'general',
		'default',
		[
			'id' => 'email_delay',
			'option_name' => 'email_delay'
		]
	);
}
add_action('admin_menu', 'add_option_field_to_general_admin_page');

function email_setting_delay_callback( $val ) {
	$id = $val['id'];
	$option_name = $val['option_name'];
	$option_value = esc_attr(get_option($option_name)) ?: 20;
	?>
	<label for="<?= $option_name ?>">
		<input
			type="number"
			name="<?= $option_name ?>"
			id="<?= $id ?>"
			value="<?= $option_value; ?>"
			min="0"
			step="0.1"
		/>
	</label>
	<?
}