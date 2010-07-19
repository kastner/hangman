<?php
$allowed = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$ok = "1234567890,\.\/\&' ";
$blank = "_";

$states = array(
  "HANG MAN... GO!",
  "[1/6] o",
  "[2/6] o--",
  "[3/6] o,-",
  "[4/6] o|-",
  "[5/6] o|-/",
  "[6/6] 8|-X GAME OVER!"
);

function fmt($str) {
  global $blank;
  if ($str == " ") { $str = "|"; }
  return " $str ";
}
