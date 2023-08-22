<?php
  /**
   * 課題１：mysqliを用いてMySQLに接続し，POSTで受け取ったデータをtrx_usersにINSERTする処理を書いてください
   * パスワードはハッシュ化する必要があるので，以下の$password_hashを用いてください
   * 
   */

   //escape function
function h(string $str): string{
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}






$mysqli = new mysqli('localhost', 'brightech', 'brightech', 'test');

//接続状況の確認
if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset('utf8');
}

if (isset($_POST["username"])){
  $name = $_POST["username"];
  $pass = $_POST["password"];
  $password_hash = hash("sha256", $pass);

  $sql = "INSERT INTO trx_users (`user_name`,`password`) VALUES ('".$name."','".$password_hash."')";
  $mysqli->query($sql);
  $mysqli->close();
}


// 切断




var_dump($name);






   
?>

<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8">*:
	</head>
	<body>
		<h2>ユーザ追加</h2>
		<form action="newUser.php" method="post">
		  ユーザ: <input type="text" name="username" /><br/>
		  パスワード: <input type="password" name="password" /><br/>
		  <input type="submit"name="submitButton" />
		</form>
	</body>
</html>
