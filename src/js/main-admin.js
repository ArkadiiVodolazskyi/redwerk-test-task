jQuery(document).ready($ => {
	const media_select_image = $('#media-select-image');

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
			media_select_image.attr('src', attachment.url);
			$('.media-custom-field-remove').show();
		});
		media_frame.open();
	});
	$('.media-custom-field-remove').click(e => {
		e.preventDefault();
		const media_select_field = $('#media-select-field');
		media_select_field.val('');
		media_select_image.attr('src', '');
		$(this).hide();
	});
});