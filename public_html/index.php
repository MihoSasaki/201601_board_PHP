<?php

 
require_once(__DIR__ . '/../config/config.php');
 
// var_dump($_SESSION['me']);
 
$app = new MyApp\Controller\Index();
 
$app->run();
 
// $app->me()
// $app->getValues()->users
 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <h1>Users <span class="fs12">(<?= count($app->getValues()->users); ?>)</span></h1>
    <ul>
      <?php foreach ($app->getValues()->users as $user) : ?>
        <li><?= h($user->email); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
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
  <table class="table table-striped">
   <p>ここに内容を表示する。</p>
     <tr>
       <th>タイトル</th>
       <th>内容</th>
       <th>削除</th>
     </tr>
    </table>
</body>
</html>