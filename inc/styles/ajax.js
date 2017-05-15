$( function() 
{
	$( 'body' ).on( 'click', 'a.AJAX', function( e )
	{
		e.preventDefault();
		
		if ( $( this ).attr( 'data-title' ) != undefined )
		{
			$( 'title' ).html( $( this ).attr( 'data-title' ) );
		}
		
		$( '#BLOCK1' ).load( $( this ).attr( 'href' ) );
	});
	$( 'body' ).on( 'submit', 'form.AJAX', function( e )
	{
		e.preventDefault();
		
		var formData = new FormData( $( this ).get(0) );
		
		$( 'title' ).html( 'Результат' );
		
		$.ajax(
		{
			url: $( this ).attr( 'action' ),
			type: $( this ).attr( 'method' ),
			contentType: false, // важно - убираем форматирование данных по умолчанию
			processData: false, // важно - убираем преобразование строк по умолчанию
			data: formData,
			dataType: 'HTML',
			success: function( h )
			{
				$( '#BLOCK1' ).html( h );
			}
		});
	});
});