<?php
session_start();

$riddles = array(
  array(
    "question" => "Старый дед, во сто шуб одет, кто его раздевает, тот слезы проливает.",
    "answer" => "бомж",
    "letter" => "с"
  ),
  array(
    "question" => "Романтическое место в компьютере, где может причалить усталое и потрепанное бурями периферийное устройство?",
    "answer" => "порт",
    "letter" => "л"
  ),
  array(
    "question" => " Программист просит у друга денег в долг: “Одолжи 250$ до получки, ну или для круглого счета ...:",
    "answer" => "256",
    "letter" => "о"
  ),
  array(
    "question" => "два документа Microsoft Word:",
    "answer" => "парадокс",
    "letter" => "в"
  ),
  array(
    "question" => "Данная страница не найдена, код:",
    "answer" => "404",
    "letter" => "о"
  ),
  array(
    "question" => "Количество шампуров на фотографии в ВК Дмитрия Андреевича?",
    "answer" => "12",
    "letter" => ""
  )
);

$currentStage = isset($_SESSION['stage']) ? $_SESSION['stage'] : 0;
$totalStages = count($riddles);

if (isset($_POST['answer'])) {
  $answer = mb_strtolower($_POST['answer']);
  if ($answer === $riddles[$currentStage]['answer']) {
    $currentStage++;
    $_SESSION['stage'] = $currentStage;
    if ($currentStage > 0) {
      $previousLetter = $riddles[$currentStage - 1]['letter'];
    }
  }
}

if ($currentStage >= $totalStages) {
  echo "Игра окончена! Вы успешно разгадали все загадки. Полученная буква: Р ";
  session_destroy();
  exit;
}

$question = $riddles[$currentStage]['question'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Цыденов</title>
</head>
<body>
  <h1>Загадки</h1>

  <?php if (isset($question)) : ?>
    <h2>Комната <?php echo $currentStage + 1; ?></h2>
    <p><?php echo $question; ?></p>
    <?php if (isset($previousLetter)) : ?>
      <p>Полученная буква: <?php echo $previousLetter; ?></p>
    <?php endif; ?>
    <form method="post" action="">
      Ответ: <input type="text" name="answer">
      <input type="submit" value="Отправить">
    </form>
  <?php endif; ?>
</body>
</html>
