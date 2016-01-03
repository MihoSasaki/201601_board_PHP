
<?php
define('DB_DATABASE','messageboard');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','YUIyui15');
define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);

$type = (isset($_POST['type']))? $_POST['type'] :null;
//if($id = $_GET['id']){}
try{
//connect
	$db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($type=='create'){
//書き込み
$sql_thread = $db->prepare("update responses set name = :name body = :body ");
 $sql_thread->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
 $sql_thread->bindValue(':body', $_POST['body'], PDO::PARAM_STR);
 //$sql_thread->bindValue(':time', $created_at->format('Y-m-d H:i:s'), PDO::PARAM_STR);
 $sql_thread->execute();
}
//スレッドIDを取得
//$id = (isset($_GET['id']))? $_GET['id']:null;  
//$id = $_GET['id'];
if (isset($_GET['id'])){
//スレッドを取得
//$sql_thread = $db-> prepare("select * from threads where id = ?");
$sql_thread = $db-> prepare("select * from threads where id = :id ");
//$sql_thread->execute([$id]);
$sql_thread->bindValue(':id', $id, PDO::PARAM_INT);
$sql_thread->execute();
$result_thread = $sql_thread->fetchAll(PDO::FETCH_CLASS);
foreach ($result_thread as $thread) {
  echo "<tr>";
  echo "<td>作成日時:$thread{$row['created_at']}</td>";
  echo "<td>タイトル:$thread{$row['title']}</td>";
  echo "<td>$thread{$row['body']}</td>";
//スレッドの内容 
 }

try{
//全レスを取得
$sql_res = $db->prepare("select * from responses where thread_id = :id order by created_at desc");
$sql_res->bindValue(':id', $id, PDO::PARAM_INT);
$sql_res->execute();
$result_res = $sql_res->fetchClass(PDO::FETCH_CLASS);
foreach ($sql_res as $res) {
  echo "<tr>";
  echo "<td>作成日時:$res{$row['body']}</td>";
  echo "<td>タイトル:$res{$row['created_at']}</td>";
  echo "</tr>";
  echo "<td><a href='res_del.php?thread_id=$thread_id'>削除</a></td>";
  }
}catch(PDOException $e){
  var_dump($e);
}
}
}
catch(PDOException $e){
  echo $e ->getMessage();
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
<title>トップ</title>
</head>
<body>
<p><a href="thread2.php?id=<?php echo $id;?>">書き込み</a></p>
<form method="post" action="thread.php">
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
        <input type="hidden" name="res" value="<?php echo $id;?>" />
        <input type="hidden" name="type" value="create" />
      </td>
        <td><input type="submit" name="submit" value="投稿" /></td>
    </tr>
  </table>
</form>
</body>
</html>
