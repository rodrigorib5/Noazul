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
