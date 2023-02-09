jQuery(document).ready($ => {
	$('#media-select-button').click(e => {
		e.preventDefault();
		const media_select_field = $('#media-select-field');
		const media_frame = wp.media({
			title: 'Select or Upload Media',
			button: {
				text: 'Use this media'
			},
			multiple: false
		});
		media_frame.on('select', () => {
			const attachment = media_frame.state().get('selection').first().toJSON();
			media_select_field.val(attachment.id);
			$('.media-custom-field-remove').show();
		});
		media_frame.open();
	});
	$('.media-custom-field-remove').click(e => {
		e.preventDefault();
		const media_select_field = $('#media-select-field');
		media_select_field.val('');
		$(this).hide();
	});
});