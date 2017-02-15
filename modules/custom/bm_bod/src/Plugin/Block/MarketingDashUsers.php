<?php
namespace Drupal\bm_bod\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Query;
use Drupal\bm_bod\Queries\InvestmentQuery;

/**
 * Provides a block that shows users data for Marketing.
 *
 * @Block(
 *   id = "marketing_users",
 *   admin_label = @Translation("Marketing Users"),
 * )
 */
class MarketingDashUsers extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

//    $query = \Drupal::entityQuery('bm_bod_account')
//      ->condition('owner.value', '329', '=');
//
//    $uids = $query->execute();
//    dpm($uids,'array of uids');

//    $allEntities = \Drupal::entityTypeManager()->getDefinitions();
//    dpm($allEntities,'node entities');


    $userInvestedCount = InvestmentQuery::getDebtPercentage(308);
    var_dump($userInvestedCount);

    $data = $this->getData();
//    $output = $form . $data;
    return array(
      '#markup' => render($data),
    );

  }

  public function getData() {
    // Returns a Drupal\Core\Database\Connection object.
    $db = \Drupal::database();


    $query = \Drupal::entityQuery('user')
//      ->condition('name', 'robert', 'CONTAINS')
//      ->condition('uid', 80, '!=')
      ->condition('status', 1);

    $uids = $query->execute();



//    $results = $db->select('users_field_data', 'ufd')
//      ->fields('ufd', array('uid', 'name', 'mail'))
//      ->execute()->fetchAll(\PDO::FETCH_OBJ);

//    $results = $db->select('users_field_data', 'ufd')
//      ->fields('ufd', array('uid', 'created', 'mail'))
//      ->fields('name', array('field_first_name_value'))
//      ->fields('surname', array('field_last_name_value'))
//      ->innerJoin('bm_bod_account', 'account', 'account.owner = ufd.uid')
//      ->innerJoin('user__field_first_name', 'name', 'name.entity_id = users.uid')
//      ->innerJoin('user__field_last_name', 'surname', 'surname.entity_id = users.uid')
//      ->condition('users.uid', 80, '!=');




//var_dump($uids);



    foreach ($uids as $row) {
      $rows[] = array('data' => (array) $row);
    }

    $header = array(
      'Uid',
      'Created',
      'Email',
      'First name',
      'Last name',
    );

    $form = \Drupal::formBuilder()->getForm('Drupal\bm_bod\Form\UsersListForm');
    $build = array(
      '#markup' => render($form),
    );


    $build['results_table'] = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    );

    return $build;
  }
}
