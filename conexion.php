<?php

$conexion = mysqli_connect('localhost', 'root', '', 'kairos');

if(!$conexion){
  die("Conexión fallida: " .mysqli_connect_error());  
}else{
  echo "";
}

?>