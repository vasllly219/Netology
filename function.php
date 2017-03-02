<?php
define('FILE_DATA', __DIR__ . '/tests.json');

function getInputValues($inputData)
{
  $defaultInputData = [
    'number' => '0',
    'question' => '',
    'answer' => ''
  ];
  return array_merge($defaultInputData, $inputData);
}

function isPOST()
{
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function getParam($name, $defaultValue = null)
{
  return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $defaultValue;
}

function validateData($inputData)//fixme
{
  $errors = [];
  foreach ($inputData as $item => $value) {
    if($value === ''){
      $message = 'не должно быть пустым';
      $errors[$item] = $message;
    }
  }
return $errors;
}

function setData($inputData)
{
  $data = getData();
  $inputData['number'] = count($data) + 1;
  $data[] = $inputData;
  if(file_put_contents(FILE_DATA, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT))) {
    return true;
  } else {
    return false;
  }
}

function getData()
{
  $data = [];
  if (file_exists(FILE_DATA)) {
    $data = json_decode(file_get_contents(FILE_DATA), true);
    if (!$data) {
      return [];
    }
  }
  return $data;
}

function getLabel($name)
{
  $labels =  [
    'question' => 'Вопрос',
    'answer' => 'Ответ',
  ];
  return isset($labels[$name]) ? $labels[$name] : $name;
}

/////

function findTest($list){
  foreach ($list as $value) {
    if ((string)$value['number'] === $_GET['list']){
      return $value;
    }
  }
}

function getTitle($test){
  if (is_array($test)){
    return 'Тест №' . $test['number'];
  } else{
    echo '<h1>Тест не найден(</h1>';
    die;
  }
}

function validAnswer($answerTest, $answerUser){
  if($answerUser === NULL){return '';}
  if ($answerTest === $answerUser){
    return 'Правильно';
  }
  return 'Не верно';
}
