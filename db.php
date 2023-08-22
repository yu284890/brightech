<?php
// 接続
$mysqli = new mysqli('localhost', 'brightech', 'brightech', 'test');

//接続状況の確認
if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset('utf8');
}

$sql = "SELECT * FROM user;";
var_dump($sql);
$result = $mysqli->query($sql);


while($row = $result->fetch_assoc() ){
    echo $row['id'] . " " .$row['name'] . "<br/>";
}

// 切断
$mysqli->close();
?>