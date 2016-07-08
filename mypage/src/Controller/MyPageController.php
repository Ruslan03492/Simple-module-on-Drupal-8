<?php
/**
 * @file
 * Contains \Drupal\mypage\Controller\MyPageController.
 */

namespace Drupal\mypage\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MyPageController extends ControllerBase {
  // Название переменной такоже как в роуте!!!
  public function content($mypage_id = NULL) {
    // Загрузка сервиса.
    $db_logic = \Drupal::service('mypage.db_logic');
    if ($record = $db_logic->getById($mypage_id, TRUE)) {
      return array(
        // Работа с нашей темой.
        '#theme' => 'mypage_theme',
        '#data' => $record,
      );
    }
    // Вернет страница не найдена.
    throw new NotFoundHttpException();
  }
}
