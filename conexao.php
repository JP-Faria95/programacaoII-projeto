<?php

$host = 'localhost';
$user = 'root';
$senha = '1234';
$bdnome = 'Projeto_Ling_Prog_2';

$con = new mysqli($host,$user,$senha,$bdnome);

if($con -> connect_error){
    die("Falha na conexão com o banco de dados: " .$con->connect_error);
}

$con -> set_charset("utf8");