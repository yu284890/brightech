<section>
    <form action="" method="post">
        名前:<br>
        <input type="text" name="name" value=""><br>
        <br>
        パスワード:<br>
        <input type="text" name="password" value=""><br>
        <input type="submit" value="登録">
    </form>
</section>

<?php
// 接続


//escape function
function h(string $str): string{
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}



$user = "brightech";
$password = "brightech";


var_dump($user);



$dbh = new PDO("mysql:host=localhost; dbname=test; charset=utf8", "$user", "$password");


$name = h($_POST["name"]);
$pass = h($_POST["password"]);

$stmt = $dbh->prepare("INSERT INTO user (name, password) VALUES (:name, :pass)");

$stmt->execute(array(':name' => $name,':pass' => $pass));











$dbh = null;

?>