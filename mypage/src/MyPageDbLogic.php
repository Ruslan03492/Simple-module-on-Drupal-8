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
    $query = $this->database->select('mypage');
    $query->fields('mypage', array('id', 'title', 'body'));
    $result = $query->execute()->fetchAll();
    if (count($result)) {
      return $result;
    }
    return FALSE;
  }

}
