<head>
<script src="print.min.js"></script>

<?php

	require_once __DIR__ . '\vendor\autoload.php';

	
	// ** Reemplazar esto por datos de GET
	$tipo_comp_id = 3;
	$prefijo_comp = 0;
	$sufijo_comp = 7877271;
	$letra_comp = "B";
	// **
	
	$date = date('ymdhis');
	$loc = 'Location: /IReport/report/pdf/fact_mensual_' . $letra_comp . '-' . $prefijo_comp . '-' . $sufijo_comp . '-' . $date . '.pdf';
	//echo $loc;
	
	use JasperPHP\JasperPHP as JasperPHP; 		
	$jasper = new JasperPHP;
	
	//$jasper->compile(__DIR__ . '/report/fact.jrxml')->execute();
	$x= $jasper->process(
		__DIR__ . '/report/fact_mensual.jasper',
		false,
		array("pdf"),
		array("php_version" => phpversion(),
			"tipo_comp_id" => $tipo_comp_id,
			"prefijo_comp" => $prefijo_comp, 
			"sufijo_comp" => $sufijo_comp,
			"letra_comp" => $letra_comp),
		array(
		  'driver' => 'mysql',
		  'username' => 'upcn',
		  'password' => '123',
		  'host' => '127.0.0.1',
		  'database' => 'upcn',
		  'port' => '3306',
		)
	  )->execute();
	    
	rename(__DIR__ . '/report/fact_mensual.pdf', __DIR__ . '/report/pdf/fact_mensual_' . $letra_comp . '-' . $prefijo_comp . '-' . $sufijo_comp . '-' . $date . '.pdf');	

	$pdfjs = '/IReport/report/pdf/fact_mensual_' . $letra_comp . '-' . $prefijo_comp . '-' . $sufijo_comp . '-' . $date . '.pdf';
	
	//header($loc);
	
	echo(" 
		<script type='text/javascript'> 
			function mypdf() {
				alert('$pdfjs'); 
				printJS('$pdfjs');
			}
			window.onload = mypdf; 		
		</script>	
		</head>
	");
?>