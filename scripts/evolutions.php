<?php

$ini = parse_ini_file('app.ini');

$source = "sqlite:" . $ini['database'];

$evolutions = [
  'CREATE TABLE IF NOT EXISTS items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    item_content TEXT NOT NULL
  )'
];

try
{
  $connection = new \PDO($source);

  foreach($evolutions as $key => $evolution) {
    if ( $key != array_key_last($evolutions) ) echo '<br>';
    $connection->exec($evolution);
  }
}
catch (\PDOException $e)
{
  echo $e->getMessage();
}

?>