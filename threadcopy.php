<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
<title>トップ</title>
</head>
<body>

<?php
define('DB_DATABASE','messageboard');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','YUIyui15');
define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);
$id = (isset($_GET['id']))? $_GET['id']:null;
class get_thread{
  public function show(){
  echo "<p>作成日時:$this->created_at</p>";
	echo "<p>タイトル:$this->title</p>";
	echo "<p>$this->body</p>";
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
}
if($id = $_GET['id']){
try{
//connect
	$db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//スレッドIDを取得
  
  //if($id=='save'){

//スレッドを取得
 //$sql_thread = "select * from threads where id = ".$id;
//$sql_thread = $db-> prepare("select * from threads where id = ?");
$sql_thread = $db-> prepare("select * from threads where id = :id ");
//$sql_thread->execute([$id]);
$sql_thread->bindVale(':id', $id, PDO::PARAM_INT);
$sql_thread->execute();
$result_thread = $sql_thread->fetchAll(PDO::FETCH_CLASS, 'get_thread');
//$sql_thread->execute();
foreach ($result_thread as $thread) {
  $thread->show();
}

//レスを取得
//$sql_res = $db->prepare("select * from responses where thread_id = $id ,".$id ."order by created_at desc");
$sql_res = $db->prepare("select * from responses where thread_id = :id order by created_at desc");
//$sql_res->execute([$id]);
$sql_res->bindValue(':id', $id, PDO::PARAM_INT);
$sql_res->execute();
$result_res = $sql_thread->fetchAll(PDO::FETCH_CLASS, 'get_res');
foreach ($sql_res as $res) {
  $res->show();
}

}

catch(PDOException $e){
  echo $e ->getMessage();
  exit;
}
}
?>
</body>
</html>