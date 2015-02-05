/**
 * 
 */
$( '#selectSituacao' ).change(function(){
	
	var valorSituacao = $(this).val();
	var url = '/novo_sim/controllers/formsController.php';
	var data = {
			tipo: "buscaMotivos",
			idSituacao: valorSituacao,
		};
	
	$.post(url, data, function(response){
		
		var resposta = "<option>-- Selecione --</option>";
		
		console.log(response);
		for(i in response){
			resposta += "<option value='"+ response[i].motivoId +"' >"+ response[i].motivoDescricao +"</option>";
		}
		
		$('#selectMotivo').html(resposta);

	}, "json").error(function(response, status){		
	});	
	
});
