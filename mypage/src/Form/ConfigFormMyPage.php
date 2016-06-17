<?php

/**
 * @file
 * Contains \Drupal\mypage\Form\ConfigFormMyPage.
 */

namespace Drupal\mypage\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigFormMyPage extends ConfigFormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'configform_mypage_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $form['title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#required' => TRUE,
    );
    $form['body'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Body'),
      '#rows' => 5,
      '#required' => TRUE,
    );
    $db_logic = \Drupal::service('mypage.db_logic');
    $data = $db_logic->getAll();
    if ($data) {
      $form['data'] = array(
        '#type' => 'table',
        '#caption' => $this->t('Table Data'),
        '#header' => array($this->t('id'), $this->t('Title'), $this->t('Body')),
      );
      foreach ($data as $item) {
        $form['data'][] = array(
          'id' => array(
            '#type' => 'markup',
            '#markup' => $item->id,
          ),
          'title' => array(
            '#type' => 'markup',
            '#markup' => $item->title,
          ),
          'body' => array(
            '#type' => 'markup',
            '#markup' => $item->body,
          ),
        );
      }
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $db_logic = \Drupal::service('mypage.db_logic');
    $db_logic->add($form_state->getValue('title'), $form_state->getValue('body'));
    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['configform_mypage.settings'];
  }

}