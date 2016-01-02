<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
<title>トップ</title>
</head>
<body>
<p><a href="thread_new.php">スレッド作成</a></p>
<table>
<?php
define('DB_DATABASE','messageboard');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','YUIyui15');
define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);

class User{
  public function show(){
    echo "<tr><td><a href=thread.php?id= $this->id>";
    echo "$this->title</a></td>";    
    echo "<td>$this->created_at</td></tr>";
  }
}

try{
//connect
	$db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = $db->query("select * from threads order by created_at desc");
//$sql ->bindValue(1,1, PDO::PARAM_INT);
$result = $sql->fetchAll(PDO::FETCH_CLASS, 'User');
  //while($thread = mysql_fetch_array($result)): 
  foreach($result as $thread){
  $thread->show(); 
}
//disconnect
    //$db = null;

}
catch(PDOException $e){
  echo $e ->getMessage();
  exit;
}
?>
</table>
</body>
</html>