<?php

namespace Drupal\mypage;

use Drupal\Core\Database\Connection;

/**
 * Defines a storage handler class that handles the node grants system.
 *
 * This is used to build node query access.
 *
 * @ingroup mypage
 */
class MyPageDbLogic {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Constructs a MyPageDbLogic object.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */
  // Переменная $database придетела к нам из аргумента сервиса.
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * Add new record in table mypage.
   */
  public function add($title, $body) {
    if (empty($title) || empty($body)) {
      return FALSE;
    }
    // Пример работы с БД в Drupal 8.
    $query = $this->database->insert('mypage');
    $query->fields(array(
      'title' => $title,
      'body' => $body,
    ));
    return $query->execute();
  }

  /**
   * Get all records from table mypage.
   */
  public function getAll() {
    return $this->getById();
  }

  /**
   * Get records by id from table mypage.
   */
  public function getById($id = NULL, $reset = FALSE) {
    $query = $this->database->select('mypage');
    $query->fields('mypage', array('id', 'title', 'body'));
    if ($id) {
      $query->condition('id', $id);
    }
    $result = $query->execute()->fetchAll();
    if (count($result)) {
      if ($reset) {
        $result = reset($result);
      }
      return $result;
    }
    return FALSE;
  }

}
