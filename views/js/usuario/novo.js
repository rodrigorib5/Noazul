/**
 * 
 */
$( '#form_novo_usuario' ).on( 'submit', function( event ) {
	event.preventDefault();
	var data = $( this ).serialize();
	var url  = $( this ).prop( 'action' );
	
	$( '#nome' ).val( '' );
	$( '#siapePesquisado' ).val( '' );

	$.post( $( this ).prop( 'action' ), data, function( response ) {
		if ( typeof response.nome !== 'undefined' ) {
			$( '#nome' ).val( response.nome );
			$( '#siapePesquisado' ).val( response.siape );
		} else {
			$( '#nome' ).val( '(NÃO ENCONTRADO)' );
			$( '#siapePesquisado' ).val( '(NÃO ENCONTRADO)' );
		}
	}, 'json');
});