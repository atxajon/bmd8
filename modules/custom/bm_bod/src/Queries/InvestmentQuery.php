<?php

namespace Drupal\bm_bod\Queries;

class InvestmentQuery {

  public static function getUserTotalInvestment($uid) {
    // Returns a Drupal\Core\Database\Connection object.
    $db = \Drupal::database();
    $data = $db->query('SELECT SUM(investment_amount) total_invested
    FROM {bm_bod_investment}
    WHERE investor_id = :uid
      AND status = 1', array(":uid" => $uid))->fetchField();

    // Equivalent with entityQueryAggregate.
    // $data = \Drupal::entityQueryAggregate('bm_bod_investment')
    //    ->aggregate('investment_amount', 'SUM')
    //    ->condition('status', 1, '=')
    //    ->condition('investor_id', $uid, '=')
    //    ->execute();

    return $data;
  }

  public static function getUserCountOfInvestments($uid) {
     $data = \Drupal::entityQueryAggregate('bm_bod_investment')
        ->aggregate('id', 'COUNT')
        ->condition('status', 1, '=')
        ->condition('investor_id', $uid, '=')
        ->execute();

    return $data;
  }

  /**
   * Returns the percentage of invested amount to the amount available.
   */
  public static function getDebtPercentage($nid) {
    $total = \Drupal::entityQueryAggregate('bm_bod_investment')
      ->aggregate('investment_amount', 'SUM')
      ->condition('status', 4, '!=')
      ->condition('investment_id', $nid, '=')
      ->execute();

    $db = \Drupal::database();
    $term = $db->query("SELECT field_amount_available_value FROM {node__field_amount_available} WHERE entity_id=:id", array(":id" => $nid))
      ->fetchField();

    $data = number_format(($term / $total[0]['investment_amount_sum']), 2);
    return $data;
  }

  public static function getLoanTotalInvestment($nid) {
    $db = \Drupal::database();
    $data = $db->query('SELECT SUM(investment_amount) total_invested
    FROM {bm_bod_investment}
    WHERE investment_id = :nid
      AND investor_id <> 80
      AND status != 4', array(
      ":nid" => $nid,
    ))->fetchField();
    return $data;
  }
}