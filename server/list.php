<?php
require_once './utils.php';

$files = scandir(ROOT_PATH);
$books = array();

foreach ($files as $file) {
  if ($file[0] === '.') {
    continue;
  }

  if (ends_with($file, '.fb2') || ends_with($file, '.fb2.zip') || ends_with($file, '.epub')) {
    array_push($books, $file);
  }
}

header('Content-Type: application/json');
echo json_encode($books);
