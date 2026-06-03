<?php

class Index extends Controller {
  public static function view() {
    global $ini;

    $source = "sqlite:" . $ini['database'];
    $connection = new \PDO($source);

    $sql = 'SELECT * FROM items';

    $statement = $connection->prepare($sql);
    $statement->execute();

    $items = $statement->fetchAll(\PDO::FETCH_ASSOC);

    parent::render(["items" => $items]);
  }
}

?>