<?php

$host   = getenv('DB_HOST');
$user   = getenv('DB_USER');
$senha  = getenv('DB_PASS');
$bdnome = getenv('DB_NAME');

echo "Host: " . $host;
echo "User: " . $user;
echo "Senha: " . $senha;
echo "Nome: " . $bdnome;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$con = new mysqli($host,$user,$senha,$bdnome);

if($con -> connect_error){
    die("Falha na conexão com o banco de dados: " .$con->connect_error);
}

$con -> set_charset("utf8");
