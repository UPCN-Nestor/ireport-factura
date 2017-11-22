<?php

	require_once __DIR__ . '/vendor/autoload.php';
	
	// ** Reemplazar esto por datos de GET
	$tipo_comp_id = $_GET["tipo"];
    $letra_comp = $_GET["letra"];
	$prefijo_comp =$_GET["pto"];
	$sufijo_comp = $_GET["nro"];
	// **
	//$hora =  date('ymdhis');
	$loc = 'Location: report/pdf/fact_mensual_' . $letra_comp . '-' . $prefijo_comp . '-' . $sufijo_comp . 		'.pdf';
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
			"letra_comp" => $letra_comp,
           "SUBREPORT_DIR" => "/var/www/sites/upcnecochea/upcnecochea.com.ar/subdomains/www/html/iReport/report/"),
		array(
		  'driver' => 'mysql',
		  'username' => 'upcn',
		  'password' => 'ncpu2010',
		  'host' => '127.0.0.1',
		  'database' => 'upcn',
		  'port' => '3306',
		),
		false
	  )->execute();
	
		
	//echo __DIR__ . '/report/';
	print_r($x);
	
	rename(__DIR__ . '/report/fact_mensual.pdf',
		__DIR__ . '/report/pdf/fact_mensual_' . $letra_comp . '-' . $prefijo_comp . '-' . $sufijo_comp . '.pdf');

	header($loc);
	

?>