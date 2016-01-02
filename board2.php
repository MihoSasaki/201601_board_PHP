
<?php
define('DB_DATABASE','messageboard');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','YUIyui15');
define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);

class User{
  public function show(){
    echo "<tr><td><a href=thread2.php?id= $this->id>";
    echo "$this->title</a></td>";    
    echo "<td>$this->created_at</td></tr><br>";
  }
}

try{
//connect
	$db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//スレッド取得
$sql = $db->query("select * from threads order by created_at desc");
$result = $sql->fetchAll(PDO::FETCH_CLASS, 'User');
  foreach($result as $thread){
  $thread->show(); 
}
//disconnect
    //$db = null;
//データ更新
$type = (isset($_POST['type']))? $_POST['type'] :null;
if($type=='create'){
  $sql_thread = $db->prepare("update thread set title = :title body = :body created_at = now()");
 $sql_thread->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
 $sql_thread->bindValue(':body', $_POST['body'], PDO::PARAM_STR);
 $sql_thread->execute();
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
  <p>スレッド作成</p>
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

