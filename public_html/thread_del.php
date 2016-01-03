
<?php
echo $_GET['id']
$id = $_GET["id"];
mysql_db_query("delete from thread where id = $id");

header('index.php')
?>

のデータを削除しました。