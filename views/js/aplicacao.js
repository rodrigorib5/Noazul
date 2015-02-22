$('#exampleModal').on('show.bs.modal', function (event) {
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  $('#gasto-fixo').on('submit', function(event){
  event.preventDefault();
  var url   = '/noazul/controllers/formsController.php';
  var data  = $( this ).serialize();
    $.post(url, data, function(response){
      if(response.type == 'success'){
        window.location.reload();
      }
   
    });
  });
  var tipoGasto  = $('#exampleModalLabel').html();
  var modal = $(this)
  modal.find('.modal-title').text(tipoGasto)
})

$( "#datepicker" ).datepicker({
      dateFormat: 'dd-mm-yy',
	    dayNamesMin: [
                    'D',
                    'S',
                    'T',
                    'Q',
                    'Q',
                    'S',
                    'S',
                    'D'
                   ],
	    monthNames: [
                    'Janeiro',
                    'Fevereiro',
                    'Março',
                    'Abril',
                    'Maio',
                    'Junho',
                    'Julho',
                    'Agosto',
                    'Setembro',
                    'Outubro',
                    'Novembro',
                    'Dezembro'
                  ]
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    
$(function() {

	var url = 'controllers/formsController.php';
	var data = {
	        tipo: "grafico",
	        grafico: "donut",
	    };
	
	$.post(url, data, function(response){
	    Morris.Donut({
	                    element: 'morris-donut-chart',
	                    data: JSON.parse(response),
	                    resize: true,
	                 });
	});
	    

});

$(function(){
    $("#valor").maskMoney({
    	 showSymbol:true, 
       symbol:"R$",
    	 thousands:''
    });
})
