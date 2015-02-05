$('button.lancar').on('click', function(){
    alert(2)
})

/* Deleta ocorrência */
$(document).ready(function(){
    $("#dlgConfirm").hide();
});

$(".deletaOcorrencia").click(function(){
	
		var id = $(this).val();
		var url = '/novo_sim/controllers/formsController.php';
		var data = {
				tipo: "alerta",
				acao: "excluir",
				idAlerta: id,
			};
	
      var $row = $(this).parents('tr');
        $( "#dlgConfirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Deletar": function () {               	
                    
                	$.post(url, data, function(response){   
                		if(response.type == 'success'){                			
                			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Ocorrência excluida com sucesso !');
                			$row.remove();
                		}else{                			
                			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Ocorreu um erro ao tentar exluir a ocorrência !');                			
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

/* Finalizar ocorrência */
$(document).ready(function(){
    $("#dlgConfirmFina").hide();
});

$(".finalizaOcorrencia").click(function(){
	
		var id = $(this).val();
		var url = '/novo_sim/controllers/formsController.php';
		var data = {
				tipo: "alerta",
				acao: "finalizar",
				idAlerta: id,
			};
	
      var $row = $(this).parents('tr');
        $( "#dlgConfirmFina" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Finalizar": function () {               	
                    
                	$.post(url, data, function(response){   
                		if(response.type == 'success'){                			
                			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Ocorrência Finalizada com sucesso !');
                			$row.remove();
                		}else{                			
                			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Ocorreu um erro ao tentar Finalizar a ocorrência !');                			
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

/* Deleta Motivo */
$(document).ready(function(){
    $("#dlgConfirm").hide();
});

$(".deletaMotivo").click(function(){
	
		var id = $(this).val();
		var descricao = $(this).val();
		var url = '/novo_sim/controllers/formsController.php';
		var data = {
				tipo: "motivo",
				acao: "excluir",
				idMotivo: id,
				descricao: descricao,				
			};
	
      var $row = $(this).parents('tr');
        $( "#dlgConfirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Excluir": function () {               	
                    
                	$.post(url, data, function(response){   
                		if(response.type == 'success'){                			
                			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Motivo deletado com sucesso !');
                			$row.remove();
                		}else{                			
                			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Ocorreu um erro ao tentar exluir o motivo !');                			
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

/* Deleta usuário */
$(".deletaUsuario").click(function(){
	
	var id = $(this).val();
	var nome = $(this).val();
	var siape = $(this).val();
	var url = '/novo_sim/controllers/formsController.php';
	var data = {
			tipo: "usuario",
			acao: "excluir",
			idUsuario: id,
			nomeUsuario: nome,
			siapeUsuario: siape,				
		};

  var $row = $(this).parents('tr');
    $( "#dlgConfirm" ).dialog({
        resizable: false,
        height:200,
        modal: true,
        buttons: {
            "Excluir": function () {   
            
            	$.post(url, data, function(response){   
            		if(response.type == 'success'){                			
            			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Usuário deletado com sucesso !');
            			$row.remove();
            		}else{                			
            			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Ocorreu um erro ao tentar exluir o Usuário !');                			
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
/* Deleta perfil */
$(".deletaPerfil").click(function(){
	
	var id = $(this).val();
	var descricao = $(this).val();
	var url = '/novo_sim/controllers/formsController.php';
	var data = {
			tipo: "perfil",
			acao: "excluir",
			idPerfil: id,
			descricao: descricao,				
		};

  var $row = $(this).parents('tr');
    $( "#dlgConfirm" ).dialog({
        resizable: false,
        height:200,
        modal: true,
        buttons: {
            "Excluir": function () {               	
                
            	$.post(url, data, function(response){   
            		if(response.type == 'success'){                			
            			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Perfil deletado com sucesso !');
            			$row.remove();
            		}else{                			
            			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Ocorreu um erro ao tentar exluir o motivo !');                			
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

/* Deleta interacao */
$(document).ready(function(){
    $("#dlgConfirm").hide();
});

$(".deletaInteracao").click(function(){
	
		var id = $(this).val();
		var descricao = $(this).val();
		var url = '/controllers/formsController.php';
		var data = {
				tipo: "interacao",
				acao: "excluir",
				idInteracao: id,						
			};
	
      var $row = $(this).parents('tr');
        $( "#dlgConfirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Excluir": function () {               	
                    
                	$.post(url, data, function(response){   
                		if(response.type == 'success'){                			
                			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Motivo deletado com sucesso !');
                			$row.remove();
                		}else{                			
                			$('#mensagem').prop('class', 'alert alert-'+ response.type).html('Ocorreu um erro ao tentar exluir o motivo !');                			
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


/** Mensagem de login */
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