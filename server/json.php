<?php
function json_encode($var) {
	switch (gettype($var)) {
    case 'boolean':
      return $var ? 'true' : 'false';

    // Lowercase necessary!
    case 'integer':
    case 'double':
      return $var;
    case 'resource':
    case 'string':

      // Always use Unicode escape sequences (\u0022) over JSON escape
      // sequences (\") to prevent browsers interpreting these as
      // special characters.
      $replace_pairs = array(
        // ", \ and U+0000 - U+001F must be escaped according to RFC 4627.
        '\\' => '\\u005C',
        '"' => '\\u0022',
        "\0" => '\\u0000',
        "\1" => '\\u0001',
        "\2" => '\\u0002',
        "\3" => '\\u0003',
        "\4" => '\\u0004',
        "\5" => '\\u0005',
        "\6" => '\\u0006',
        "\7" => '\\u0007',
        "\10" => '\\u0008',
        "\t" => '\\u0009',
        "\n" => '\\u000A',
        "\v" => '\\u000B',
        "\f" => '\\u000C',
        "\r" => '\\u000D',
        "\16" => '\\u000E',
        "\17" => '\\u000F',
        "\20" => '\\u0010',
        "\21" => '\\u0011',
        "\22" => '\\u0012',
        "\23" => '\\u0013',
        "\24" => '\\u0014',
        "\25" => '\\u0015',
        "\26" => '\\u0016',
        "\27" => '\\u0017',
        "\30" => '\\u0018',
        "\31" => '\\u0019',
        "\32" => '\\u001A',
        "\33" => '\\u001B',
        "\34" => '\\u001C',
        "\35" => '\\u001D',
        "\36" => '\\u001E',
        "\37" => '\\u001F',
        // Prevent browsers from interpreting these as as special.
        "'" => '\\u0027',
        '<' => '\\u003C',
        '>' => '\\u003E',
        '&' => '\\u0026',
        // Prevent browsers from interpreting the solidus as special and
        // non-compliant JSON parsers from interpreting // as a comment.
        '/' => '\\u002F',
        // While these are allowed unescaped according to ECMA-262, section
        // 15.12.2, they cause problems in some JSON parsers.
        " " => '\\u2028',
        // U+2028, Line Separator.
        " " => '\\u2029',
      );
      return '"' . strtr($var, $replace_pairs) . '"';
    case 'array':

      // Arrays in JSON can't be associative. If the array is empty or if it
      // has sequential whole number keys starting with 0, it's not associative
      // so we can go ahead and convert it as an array.
      if (empty($var) || array_keys($var) === range(0, sizeof($var) - 1)) {
        $output = array();
        foreach ($var as $v) {
          $output[] = json_encode($v);
        }
        return '[ ' . implode(', ', $output) . ' ]';
      }

    // Otherwise, fall through to convert the array as an object.
    case 'object':
      $output = array();
      foreach ($var as $k => $v) {
        $output[] = json_encode(strval($k)) . ':' . json_encode($v);
      }
      return '{' . implode(', ', $output) . '}';
    default:
      return 'null';
  }
}
