jQuery( document ).ready( function(){
	jQuery( '.font_select' ).select2( {
		ajax: {
			delay: 100,
			url: ajaxurl,
			dataType: 'json',
			data: function (params) {
				var query = {
					action: 'gfont_get_fonts',
					search: params.term,
				}

				return query;
			},
			processResults: function (data) {
				console.log( data );
				return data;
			}
		}
	} );
} );