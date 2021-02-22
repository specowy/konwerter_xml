<?php

$data=date("d-m-Y-H-i-s");
$folder=`/konwxml/`;
$plik ='exp'.$data.'.xml';
$export = $folder.$plik;

$fp = fopen($export, "w");
sleep(6);
    $static = '<?xml version="1.0" encoding="UTF-8"?>

    <Produkty>';
        fputs($fp, $static);
        
$DOKUMENT = simplexml_load_file($_FILES['plik']['tmp_name']);
    

foreach($DOKUMENT -> ZAPIS as $ZAPIS){
    $kod =$ZAPIS -> Kod;
    $cb = $ZAPIS -> CB2;
    $vat = $ZAPIS -> Vat;
    settype($vat,"integer");
    $stan = $ZAPIS -> STAN;
    $nazwa = $ZAPIS -> Nazw;
        $noweDane = "
                  <Produkt>
                      <Nr_katalogowy><![CDATA[$kod]]></Nr_katalogowy>
                      <Nazwa_produktu><![CDATA[$nazwa]]></Nazwa_produktu>
                      <Ilosc_produktow>$stan</Ilosc_produktow>
                      <Cena_brutto>$cb</Cena_brutto>
                      <Podatek_Vat>$vat</Podatek_Vat>
                  </Produkt>
                  ";
        fputs($fp, $noweDane);}
    

          fputs($fp, '
</Produkty>');
        fclose($fp);
           
            echo '<html>
	<head>
		<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=iso-8859-2">
		<title>...</title>
 		<link rel="stylesheet" href="mstyle.php" type="text/css" />
		<link rel="stylesheet" href="efekt.css" type="text/css" />
	</head>
	<body> <div class="gotowe" >Gotowe</div>
	<div ="npliku">Nazwa pliku: <span id="plik">'.$plik.'</span></div>
<div class="buttonek" style="font-size:1.5em">
			<a href='.$export.' class="btn" download='.$plik.'>Pobierz plik</a>
		</div>
	</body>';


?>
