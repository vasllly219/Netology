<?php
  require_once 'function.php';
  $list = getData();
  $test = findTest($list);
  $title = getTitle($test);
  $output = '';
  if (isset($_POST['answer'])){
    $output = validAnswer($test['answer'], $_POST['answer']);
  }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Тест</title>
</head>
<body>
  <h1><?= $title ?></h1>
  <p><?= $test['question'] ?></p>
  <form method="POST">
    <label for="answer">Ответ</label>
    <input name="answer" id="answer"><br />
    <button type="submit" >Отправить</button>
  </form>
  <p><?= $output ?></p>
</body>
</html>
