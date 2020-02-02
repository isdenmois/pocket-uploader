<?php
require_once './settings.php';

if (!function_exists('json_encode')) {
  require_once './json.php';
}

function ends_with($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function file_check_name($name) {
  // Punctuation characters that are allowed, but not as first/last character.
  $punctuation = '-_. ';

  $map = array(
    // Replace (groups of) whitespace characters.
    '!\s+!' => ' ',
    // Replace multiple dots.
    '!\.+!' => '.',
    // Remove characters that are not alphanumeric or the allowed punctuation.
    "![^0-9A-Za-z$punctuation]!" => '',
  );

  // Apply the regex replacements. Remove any leading or hanging punctuation.
  return trim(preg_replace(array_keys($map), array_values($map), $name), $punctuation);
}
