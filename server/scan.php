<?php
require_once './utils.php';

exec(START_SCAN_CMD, $mat);

if (count($mat)) {
  echo trim(implode("\n", $mat));
}
else {
  echo "exec(\"$cmd\") NoReturn...";
}
