<?php
$allowed = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$ok = "1234567890,\.\/\& ";
$blank = "_";

$states = array(
  "HANG MAN... GO!",
  "o",
  "o---",
  "o-,-",
  "o-|-",
  "o-|-/",
  "8-|-X LOSE!"
);

function fmt($str) {
  global $blank;
  if ($str == " ") { $str = "|"; }
  return " $str ";
}
