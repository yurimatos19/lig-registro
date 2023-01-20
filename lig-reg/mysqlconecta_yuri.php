<?php
/* Este arquivo conecta um banco de dados MySQL - Servidor = localhost */
$dbname   = "resumo_diario"; // Indique o nome do banco de dados que ser� aberto
$usuario  = "adminer"; // Indique o nome do usu�rio que tem acesso
$password = "@Andiamironman1"; // Indique a senha do usu�rio

//1� passo - Conecta ao servidor MySQL 
if(!($id = mysqli_connect("10.0.1.36",$usuario,$password))) {
   echo "N�o foi poss�vel estabelecer uma conex�o com o gerenciador MySQL. Favor Contactar o Administrador.<p>";
   exit;
} 
//2� passo - Seleciona o Banco de Dados 
if(!($con=mysqli_select_db($id,$dbname))) { 
   echo "N�o foi poss�vel estabelecer uma conex�o com o banco de dados selecionado. Favor Contactar o Administrador.";
   exit; 
} 

// Adicionado por Carlos Trentini para suprir a conversao de mysql_ para mysqli_
if (!function_exists('mysqli_result')) {
  function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
  }
}

?>
