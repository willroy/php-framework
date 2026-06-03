<?php

class Form extends Controller {
  public static function form() {
    parent::render();
  }

  public static function save() {
    global $_GET;
    global $ini;

    $source = "sqlite:" . $ini['database'];
    $connection = new \PDO($source);

    $sql = 'INSERT INTO items(id, item_content) VALUES(:id, :item);';

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', null);
    $statement->bindValue(':item', $_GET['form_content']);
    $statement->execute();

    parent::redirect("/");
  }
}

?>