/* Paga gasto fixo */
$(document).ready(function(){
    $("#dialog-confirm").hide();
});


/* Confirmação para pagar */
$("button.pagar").click(function(){
	
		var idGasto = $("#id-gasto").val();
		var valorGasto = $("#valor-gasto").val();
		var url = '/noazul/controllers/formsController.php';
		var data = {
				tipo: "gasto",
				acao: "pagar",
				idGasto: idGasto,
                valorGasto: valorGasto						
			};
	   
        var $row = $(this).parents('tr');
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Pagar": function () {     

                    $.post(url, data, function(response){   
                    if(response.type == 'success'){                         
                        $('#mensagem').prop('class', 'alert alert-'+ response.type).html('Gasto pago com sucesso!');
                        $row.remove();
                    }
                }, "json");

                    $( this ).dialog( "close" );
                },
                "Cancelar": function() { 
                    $( this ).dialog( "close" );
                }
            }
        });     
});


/* Mensagem de login */
$('form.login').on('submit', function(event){
	event.preventDefault();
	var login = $('#login').val();
	var senha = $('#senha').val();
	var url = '/noazul/controllers/formsController.php';
	var data = {
			tipo: "login",		
			login: login,
			senha: senha,
		};

	$.post(url, data, function(response){
		if(response.type == 'danger'){                			
			$('#erro-senha').prop('class', 'alert alert-'+ response.type).html('Usuário ou Senha incorreto');
			$('#login').val('');
			$('#senha').val('');
			$('#login').focus();
		}else if (response.type == 'warning') {
			$('#erro-senha').prop('class', 'alert alert-'+ response.type).html('Informe o Login e a Senha');
			$('#login').val('');
			$('#senha').val('');
			$('#login').focus();
		}else{                			
			window.location.href = '/noazul/';
		}
	}, "json").error(function(response, status){
		console.log(response.responseText);
	});    
});