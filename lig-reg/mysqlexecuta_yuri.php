<?php
/*
Esta fun��o executa um comando SQL no banco de dados MySQL
$id - Ponteiro da Conex�o
$sql - Cl�usula SQL a executar
$erro - Especifica se a fun��o exibe ou n�o(0=n�o, 1=sim)
$res - Resposta
*/
function mysqlexecuta($id,$sql,$erro = 1) {
    if(empty($sql) OR !($id))
       return 0; //Erro na conex�o ou no comando SQL
   if (!($res = @mysqli_query($id,$sql))) {
      if($erro)
        echo "mysqlexecuta.php - 15 - Ocorreu um erro na execucao do Comando SQL no banco de dados. Favor Contactar o Administrador.";
      exit;
   }
    return $res;
 }
?>
