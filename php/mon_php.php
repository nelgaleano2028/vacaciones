<?php
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');

@$ano = trim($_GET['ano']);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>.:Nomina del Año :.</title>

		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Valor de Nomina - Año/Periodo'
            },
            subtitle: {
                text: '.:GRAFICO ESTADISTICO DEL AÑO <?php echo $ano; ?>:.'
            },
            xAxis: {
				min: 0,
                title: {
                    text: 'Periodos'
                },
                categories: [<?php
            $qry = "Select h.cod_per, sum(case when dev_ded='V' then valor else valor*-1 end)as nomina
			from historia_liq h, conceptos c
			where h.ano = '$ano' 
			and h.cod_con = c.cod_con
			group by h.cod_per
			order by h.cod_per";
			
			$rs = $conn->Execute($qry); 
			while($row = $rs->fetchrow()){
			$periodo = $row["cod_per"];
			echo ' '.$periodo.' , '; }
                ?>]
				
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nomina (Valor)'
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                       'Periodo '+ this.x +': ' + this.y + '(valor nomina)';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [{
                name: 'Mostrar/Ocultar',
                data: [<?php
            $qry = "Select h.cod_per, sum(case when dev_ded='V' then valor else valor*-1 end)as nomina
			from historia_liq h, conceptos c
			where h.ano = '$ano'
			and h.cod_con = c.cod_con
			group by h.cod_per
			order by h.cod_per";
			
			$rs = $conn->Execute($qry); 
			while($row = $rs->fetchrow()){
			$nomina = $row["nomina"];
			echo ' '.$nomina.' , '; }
                ?>]
    
            }]
        });
    });
    
});
		</script>
   	<link rel="stylesheet" href="../development-bundle/themes/base/jquery.ui.all.css">
	<script src="../development-bundle/jquery-1.6.2.js"></script>
	<script src="../development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../development-bundle/ui/jquery.ui.button.js"></script>
	<link rel="stylesheet" href="../development-bundle/demos/demos.css">
    <script>
	$(function() {
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return false; });
	});
	</script>
        
    <style type="text/css">
    .texto {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #0194ca;
}
    </style>
	</head>
	<body>
<script src="../js/highcharts.js"></script>
<script src="../js/modules/exporting.js"></script>
<form action="mon_php.php?ano=<?php echo '$ano' ?>" method="get">
<span class="texto">Seleccione para filtrar por Año:</span>
<label>
  
  <select name="ano" id="ano">
                <option value="<?php echo @$ano;?>" selected="selected"><?php echo @$ano;?></option>
                <?php
				$qry1 = "select distinct(ano) from historia_liq order by ano";
				$rs1 = $conn->Execute($qry1); 
				while($row1 = $rs1->fetchrow()){
				$ano = $row1["ano"];
				echo '<option value="'.$ano.'">'.$ano.'</option>';
				}		
				?>
    </select>
  <span class="demo">
  <input type="submit" value="Consultar">
  </span>
</label>
</form>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
