<?php
$username = 'root';
$password = '';
try {
    //Lembar do charset=utf8 <<
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
$sql = 'SELECT * FROM rascunho_cm ORDER BY matricula_id';
$data = $conn->query($sql);
$data->setFetchMode(PDO::FETCH_ASSOC);

$to_encode = array();
while ($r = $data->fetch()){
    $to_encode[] = $r;
}
echo json_encode($to_encode);
