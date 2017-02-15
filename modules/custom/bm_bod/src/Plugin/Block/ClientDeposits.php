<?php
namespace Drupal\bm_bod\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block that shows clients deposits summary.
 *
 * @Block(
 *   id = "client_deposits",
 *   admin_label = @Translation("Client Deposits"),
 * )
 */
class ClientDeposits extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

    $deposits = $this->getDeposits();

    return array(
      '#markup' => render($deposits),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getDeposits() {
    // Returns a Drupal\Core\Database\Connection object.
    $db = \Drupal::database();

    $results = $db->select('node_field_data', 'nfd')
      ->fields('nfd', array('nid', 'title'))
      ->execute()->fetchAll(\PDO::FETCH_OBJ);

    // Or raw sql equivalent:
    // $data = $db->query('SELECT nid, title, type FROM node_field_data')->fetchAllAssoc('nid');

    foreach ($results as $row) {
      $rows[] = array('data' => (array) $row);
    }

    $header = array(
      'Nid',
      'Title',
    );

    $build = array(
      '#markup' => t('List of Node ids and titles'),
    );

    $build['results_table'] = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    );

    return $build;
  }
}
