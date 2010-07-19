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

sort($guesses);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Txt Hngmn</title>
  <meta name="viewport" content="width=320">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
</head>
<body>
  <div>
  </div>
  <div>
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
  <input type="text" size="60" id="copy" value="<?php echo $states[count($guessed)] ?> | <?php echo $out ?> [Guesses: <?php echo implode(', ', $guesses) ?>]">
<p>
<a href="index.php">start over</a>
</p>
<script>
document.getElementById("copy").focus();
document.getElementById("copy").select();
</script>
</body>
</html>
