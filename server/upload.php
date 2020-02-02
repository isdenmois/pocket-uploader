<?php
require_once './utils.php';

$file_name = file_check_name($_FILES['file']['name']);

$res = move_uploaded_file($_FILES['file']['tmp_name'], ROOT_PATH . DIRECTORY_SEPARATOR . $file_name);

header('Content-Type: application/json');
echo '{"result": "' . $res . '"}';
