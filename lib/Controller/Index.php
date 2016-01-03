<?php
 
namespace MyApp\Controller;
 
class Index extends \MyApp\Controller {
 
  public function run() {
    if (!$this->isLoggedIn()) {
      // login
      header('login.php');
      exit;
    }
 
    // get users info
    $userModel = new \MyApp\Model\User();
    $this->setValues('users', $userModel->findAll());

try{
//connect
	$db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//スレッド取得
$sql = $db->query("select * from threads order by created_at desc");
$result = $sql->FETCHAll(PDO::FETCH_CLASS);
  foreach($result as $thread){
  $thread->show(); 
  echo "<tr><td><a href=thread.php?id= $this->id>";
  echo "$this->title</a></td>";    
  echo "<td>$this->created_at</td></tr><br>";
  echo "<td><a href='thread_del.php?id=$id'>削除</a></td>";
}
//disconnect
    //$db = null;
//データ更新
$type = (isset($_POST['type']))? $_POST['type'] :null;
if($type=='create'){
  $sql_thread = $db->prepare("update thread set title = :title body = :body　name = :name created_at = now()");
 $sql_thread->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
 $sql_thread->bindValue(':body', $_POST['body'], PDO::PARAM_STR);
 $sql_thread->execute();
}


}
catch(PDOException $e){
  echo $e ->getMessage();
  exit;
}


  }
 
}