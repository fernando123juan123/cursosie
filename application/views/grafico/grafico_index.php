
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Graficos <small>...</small></h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<div id="graph"></div>
		</div>
	</div>
</div>
<script>
$( document ).ready( function() {
    var s=0;
	$.post('graficos_valor', {s}, function(data) {
		var valores = eval(data);

		Morris.Donut({
		  element: 'graph',
		  data: [
		    {value: valores[0], label: 'ACTIVO'},
		    {value: valores[1], label: 'INACTIVO'},
		    {value: valores[2], label: 'ELIMINADOS'}
		  ],
		  formatter: function (x) { return x + "%"}
		}).on('click', function(i, row){
		  console.log(i, row);
		});
	});
} )

</script>