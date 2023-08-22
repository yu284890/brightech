<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $password_hash = hash("sha256", $password);
  // MySQLに接続
  $mysqli = new mysqli('localhost', 'brightech', 'brightech', 'test');
  if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
  } else {
    $mysqli->set_charset('utf8');
  }
  // SELECT処理
  $stmt = $mysqli->prepare("SELECT id, user_name FROM trx_users WHERE user_name = ? AND password = ?");
  if ($stmt) {
    $stmt->bind_param("ss", $username, $password_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['user_name'];
      echo "ログイン成功！";
      exit();
    }
    $stmt->close();
  } else {
    echo "Error preparing statement.";
  }
  $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログイン</h2>
		<form action="login.php" method="post">
		 ユーザ: <input type="text" name="username" /><br/>
		 パスワード: <input type="password" name="password" /><br/>
		 <input type="submit" />
		</form>
	</body>
</html>