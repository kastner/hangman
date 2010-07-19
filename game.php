<?php
include 'conf.php';
$message = "";
$game_id = $_REQUEST["game_id"];
if (!intval($game_id)) { die(); }

$guess = strtoupper(substr($_REQUEST["guess"], 0, 1));
$fname = "/tmp/$game_id.txt";
$guesses = file($fname, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
$word = array_shift($guesses);

if ($guess) {
  if (in_array($guess, $guesses)) {
    $message .= "already guessed $guess";
  } else {
    $guesses[] = $guess;
    file_put_contents($fname, $word . "\n" . implode("\n", $guesses));
  }
}

if (!$word) { die("no word"); }

$out = "";
$passable = array_merge($guesses, str_split($ok));
$guessed = $guesses;

foreach (str_split($word) as $letter) {
  if (in_array($letter, $passable)) {
    if (in_array($letter, $guessed)) { unset($guessed[array_search($letter, $guessed)]); }
    $out .= fmt($letter);
  } else {
    $out .= fmt($blank);
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Txt Hangman</title>
</head>
<body>
  <div>
    Word: <?php echo $word ?>
  </div>
  <div>
    Guessed: <?php echo implode(", ", $guesses) ?>
  </div>
  <?php if ($message) { ?><div id="message"><?php echo $message ?></div><?php } ?>
  <form method="get">
    <input type="hidden" name="game_id" value="<?php echo $game_id ?>">
    <div>
      <label>
        Guess:
        <input type="text" name="guess" size="4">
      </label>
    <input type="submit">
    </div>
  </form>
  
  <textarea rows="2" cols="60"><?php echo $states[count($guessed)] ?> | <?php echo $out ?></textarea>
</body>
</html>
