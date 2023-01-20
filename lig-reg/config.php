<?php
  include_once('include/Database.php');
  define('SS_DB_NAME', 'resumo_diario');
  define('SS_DB_USER', 'adminer');
  define('SS_DB_PASSWORD', '@Andiamironman1');
  define('SS_DB_HOST', '10.0.1.36');
 
  $dsn  =   "mysql:dbname=".SS_DB_NAME.";host=".SS_DB_HOST."";
  $pdo  =   "";
  try {
    $pdo = new PDO($dsn, SS_DB_USER, SS_DB_PASSWORD);
  }catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  $db   =   new Database($pdo);
?>