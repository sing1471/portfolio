<?php 

$dsn='mysql:host=localhost;dbname=seussology';
$user="root";
$pass="root";


$db=new PDO($dsn, $user, $pass);

try{
    $db =new PDO($dsn, $user, $pass);
} catch(PDOException $e){
    echo"$e";
    die();
}
?>