<?php 

require 'dom.php';

$html = file_get_html('https://dolar.wilkinsonpc.com.co/divisas/bolivar-cucuta.html');
$theData = array();
// Find all images 
$table = $html->find('#tabla-indicadores_ind_todos', 0);


foreach($table->find('tr') as $row) {
    $rowData = array();
    foreach($row->find('td') as $cell) {
        $rowData[] = $cell->plaintext;
    }

    $theData[] = $rowData;
}


$dolar = preg_replace('/[\$,]/', '', $theData[2][1]);
$dolar = floatval($dolar);


function get_currency( $currency ) {
  $val = preg_replace('/[\$,]/', '', $currency);
  $val = floatval($val);
  return $val;
}

$dolar = get_currency( $theData[2][1] );
$bolivar = get_currency( $theData[15][1] );

$price = $dolar / $bolivar;

?>

<!DOCTYPE html>
<html>
<head>
  <title>Dolar</title>

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div class="container">
  <section class="content">
    <h1>Precio del Dólar</h1>
    <h2 class="price"><?php echo number_format($price, 2); ?> BsF.</h2>
    <small>Source: <a href="https://dolar.wilkinsonpc.com.co/divisas/bolivar-cucuta.html">wilkinsonpc.com</a></small>
  </section>
</div>
</body>
</html>
