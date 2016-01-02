


<?php
define('DB_DATABASE','messageboard');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','YUIyui15');
define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);


$id = (isset($_GET['id']))? $_GET['id']:null;
$type = (isset($_POST['type']))? $_POST['type'] :null;

if($type=='create'){
try{

  
  //DB接続
  $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // if($id=='post'){
  if($id = $_POST['id']){
  //書き込み 
  $sql_res = $db->prepare("update responses set thread_id = :id, name = :name, body = :body, created_at = now()");
  $sql_res->bindValue(':id', $id, PDO::PARAM_INT);
  $sql_res->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
  $sql_res->bindParam(':body', $_POST['body'], PDO::PARAM_STR);
  $sql_res->execute();
$result_res = $sql_res->fetchAll(PDO::FETCH_CLASS);

  //スレッド画面に移動
  header("Location: thread.php?id". $id);
  /*<p><a href="res_new.php?id=<?php echo $id;?>">書き込み</a></p>*/
}
}
catch(PDOException $e){
  echo $e ->getMessage();
  exit;
}
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
<title>レス投稿画面</title>
</head>
<body>
<form method="post" action="res_new.php">
<table>
  <tr>
    <th>名前</th>
    <td><input type="text" name="name" /></td>
  </tr>
  <tr>
    <th>内容</th>
    <td><textarea name="body"></textarea></td>
  </tr>
  <tr>
    <td>
      <input type="hidden" name="id" value="<?php echo $id;?>" />
      <input type="hidden" name="type" value="create" />
    </td>
    <td><input type="submit" name="submit" value="投稿" /></td>
  </tr>
</table>
</form>
</body>
</html>
