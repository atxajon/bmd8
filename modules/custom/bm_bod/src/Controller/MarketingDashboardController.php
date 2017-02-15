<?php


/**
 * @file
 * Contains \Drupal\bm_bod\Controller\MarketingDashboardController.
 */

namespace Drupal\bm_bod\Controller;

use Drupal\Core\Form\FormState;
use Drupal\Core\Form\FormStateInterface;

class MarketingDashboardController {

  public function page() {
    $form = \Drupal::formBuilder()->getForm('Drupal\bm_bod\Form\UsersListForm');
    $build = array(
      '#markup' => render($form),
    );

//    $form_state = new FormState();
//    $form_state->setMethod('get');
//    $values = $form_state->getValues();
//    var_dump($values);
//    $user_email = $form_state->getValue('user_email');

    $header = array(
      'Uid',
      'Created',
      'Email',
      'First name',
      'Last name',
    );

    $query = \Drupal::entityQuery('user')
      ->condition('uid', 80, '!=')
      ->condition('status', 1);

    if ($user_email) {
      $query->condition('mail', $user_email, 'STARTS_WITH');
    }
    $uids = $query->execute();

    $entity_manager = \Drupal::entityTypeManager();
    foreach ($uids as $uid) {
      $user = $entity_manager->getStorage('user')->load($uid);

      $rows[] = array(
        'data' => array(
          $user->uid->value,
          $user->created->value,
          $user->mail->value,
          $user->get('field_first_name')->value,
          $user->get('field_last_name')->value,
        )
      );
    }

    $build['results_table'] = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    );

    return $build;
  }
}