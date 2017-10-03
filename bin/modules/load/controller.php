<?php
include 'load_data2.php';


$fp = fopen("C:\\xampp\\htdocs\\colegio\\bin\\modules\\load\\colegio.csv", "r");

       $f = new importProducts(); 
       $f->load_productos(); 
       
fclose($fp);
	?>