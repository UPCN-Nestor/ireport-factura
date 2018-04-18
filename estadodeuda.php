<?php
	require_once __DIR__ . '/vendor/autoload.php';
	
	// ** Reemplazar esto por datos de GET
	$socio = $_GET["socio"];
	$suministro = $_GET["suministro"];
	// **
	//$hora =  date('ymdhis');
	$loc = 'Location: report/pdf/estado_deuda_' . $socio . '-' . $suministro . '.pdf';
	//echo $loc;
	
	use JasperPHP\JasperPHP as JasperPHP; 		
	$jasper = new JasperPHP;
	
	//$jasper->compile(__DIR__ . '/report/fact.jrxml')->execute();
	$x = $jasper->process(
		__DIR__ . '/report/libredeuda.jasper',
		false,
		array("pdf"),
		array("php_version" => phpversion(),
			"socio" => $socio,
			"suministro" => $suministro,
            "SUBREPORT_DIR" => "/report/"),
		array(
		  'driver' => 'mssql',
		  'username' => 'sa',
		  'password' => 'mateando',
		  'host' => '192.168.0.8',
		  'database' => 'UPCCOMPROD',
		  'port' => '1433',
		),
		false
	  )->execute();
			
	//echo __DIR__ . '/report/';
	print_r($x);
	
	rename(__DIR__ . '/report/fact_mensual.pdf',
		__DIR__ . '/report/pdf/fact_mensual_' . $letra_comp . '-' . $prefijo_comp . '-' . $sufijo_comp . '.pdf');

	header($loc);
	

?>