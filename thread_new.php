<?php
define('DB_DATABASE','messageboard');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','YUIyui15');
define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);

$type = (isset($_POST['type']))? $_POST['type'] :null;


if($type=='create'){
  //DB接続
try{
  $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  //書き込み
 /*
  $sql_thread = $db->query("update threads set title = '".$_POST['title']."',body = '".
  $_POST['body']."',created_at = now()");
  $result_thread = $sql_thread->fetchAll(PDO::FETCH_CLASS);
 */
 $sql_thread = $db->prepare("update thread set title = :title body = :body created_at = now()");
 $sql_thread->bindValue(':title', $_POST['title'], PDO::PARAM_INT);
 $sql_thread->bindValue(':body', $_POST['body'], PDO::PARAM_INT);

  //スレッド画面に移動
  header("Location: board.php");

}
catch(PDOException $e)
{
  echo $e ->getMessage();
  exit;
}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
<title>スレッド作成画面</title>
</head>
<body>
<form method="post" action="thread_new.php">
<table>
  <tr>
    <th>タイトル</th>
    <td><input type="text" name="title" /></td>
  </tr>
  <tr>
    <th>内容</th>
    <td><textarea name="body"></textarea></td>
  </tr>
  <tr>
    <td><input type="hidden" name="type" value="create" /></td>
    <td><input type="submit" name="submit" value="作成" /></td>
  </tr>
</table>
</form>
</body>
</html>
