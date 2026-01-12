<?php

$host   = getenv('DB_HOST');
$user   = getenv('DB_USER');
$senha  = getenv('DB_PASS');
$bdnome = getenv('DB_NAME');

$con = new mysqli($host,$user,$senha,$bdnome);

if($con -> connect_error){
    die("Falha na conexão com o banco de dados: " .$con->connect_error);
}

$con -> set_charset("utf8");
