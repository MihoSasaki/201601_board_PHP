
<?php
echo $_GET['thread_id']
$thread_id = $_GET["thread_id"];
mysql_db_query("delete from responses where thread_id = $thread_id");

?>

のデータを削除しました。


<?php
echo $_GET['thread_id']
$thread_id = $_GET["thread_id"];
mysql_db_query("delete from thread where id = $id");

?>

のデータを削除しました。