<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
<title>トップ</title>
</head>
<body>
<form method="post" action="thread2.php">
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
<?php
define('DB_DATABASE','messageboard');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','YUIyui15');
define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);
$id = (isset($_GET['id']))? $_GET['id']:null;
/*
class get_thread{
  public function show(){
  echo "<tr>"
  echo "<td>作成日時:$this->created_at</td>";
	echo "<td>タイトル:$this->title</td>";
	echo "<td>$this->body</td>";
	}
}
?>
<p><a href="res_new.php?id=<?php echo $id;?>">書き込み</a></p>
<?php
class get_res{
  public function show(){
    echo "<p>$this->body</p>";
    echo "<p>投稿日時:$this->created_at</p>";
    }
  }*/
//if($id = $_GET['id']){}
try{
//connect
	$db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($type=='create'){
//書き込み
  $sql_thread = $db->prepare("update thread set title = :title body = :body created_at = now()");
 $sql_thread->bindValue(':title', $_POST['title'], PDO::PARAM_INT);
 $sql_thread->bindValue(':body', $_POST['body'], PDO::PARAM_INT);
 $sql_thread->execute();
}



//スレッドIDを取得  
  if($id = $_GET['id']){
 // $id = $_GET['id']
//スレッドを取得
//$sql_thread = $db-> prepare("select * from threads where id = ?");
$sql_thread = $db-> prepare("select * from threads where id = :id ");
//$sql_thread->execute([$id]);
$sql_thread->bindVale(':id', $rid, PDO::PARAM_INT);
$sql_thread->execute();
$result_thread = $sql_thread->fetchAll(PDO::FETCH_CLASS);
foreach ($result_thread as $thread) {
  echo "<tr>"
  echo "<td>作成日時:$thread{$row['created_at']}</td>";
  echo "<td>タイトル:$thread{$row['title']}</td>";
  echo "<td>$thread{$row['body']}</td>";
//スレッドの内容 
 }
}

//レスを取得
//$sql_res = $db->prepare("select * from responses where thread_id = $id ,".$id ."order by created_at desc");
$sql_res = $db->prepare("select * from responses where thread_id = :id order by created_at desc");
//$sql_res->execute([$id]);
$sql_res->bindValue(':id', $id, PDO::PARAM_INT);
$sql_res->execute();
$result_res = $sql_thread->fetchAll(PDO::FETCH_CLASS);
foreach ($sql_res as $res) {
  echo "<tr>"
  echo "<td>作成日時:$res{$row['body']}</td>";
  echo "<td>タイトル:$res{$row['created_at']}</td>";
  echo "</tr>";
  //レス一覧
  }
}
catch(PDOException $e){
  echo $e ->getMessage();
  exit;
}

?>
