<?php
/**
 * @file
 * Contains \Drupal\mypage\Controller\MyPageController.
 */

namespace Drupal\mypage\Controller;

use Drupal\Core\Controller\ControllerBase;

class MyPageController extends ControllerBase {
  // Название переменной такоже как в роуте!!!
  public function content($mypage_id = NULL) {
    $db_logic = \Drupal::service('mypage.db_logic');
//    $db_logic->add('Title', 'Body');
    print_r($db_logic->getAll());
    return array(
      '#type' => 'markup',
      '#markup' => $mypage_id,
    );
  }
}
