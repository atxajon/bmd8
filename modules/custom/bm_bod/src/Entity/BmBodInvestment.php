<?php

namespace Drupal\bm_bod\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the BM Bod Investment content entity.
 *
 * @ContentEntityType(
 *   id = "bm_bod_investment",
 *   label = @Translation("BM Bod Investment entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *   },
 *   base_table = "bm_bod_investment",
 *   fieldable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "investor_id" = "investor_id",
 *     "investment_id" = "investment_id",
 *     "investment_amount" = "investment_amount",
 *     "investment_date" = "investment_date",
 *     "interest_rate" = "interest_rate",
 *     "status" = "status",
 *     "repayment_principle" = "repayment_principle",
 *     "repayment_interest" = "repayment_interest",
 *     "amount_sold" = "amount_sold",
 *   },
 * )
 */
class BmBodInvestment extends ContentEntityBase implements ContentEntityInterface {
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fieldsConfig = [
      'id' => ['type' => 'integer', 'label' => 'ID', 'desc' => 'ID'],
      'investor_id' => ['type' => 'integer', 'label' => 'investor id', 'desc' => 'The uid of the investor.'],
      'investment_id' => ['type' => 'integer', 'label' => 'The type of account.', 'desc' => 'The nid of the investment.'],
      'investment_amount' => ['type' => 'decimal', 'label' => 'investment_amount', 'desc' =>'The investment amount.'],
      'investment_date' => ['type' => 'integer', 'label' => 'investment_date', 'desc' => 'The Unix timestamp when the investment occurred.'],
      'interest_rate' => ['type' => 'decimal', 'label' => 'interest_rate', 'desc' => 'The interest rate of the loan.'],
      'status' => ['type' => 'integer', 'label' => 'status', 'desc' => 'Investment status 0 = pending, 1 = active, 2 = completed, 3 = transferred..'],
      'repayment_principle' => ['type' => 'decimal', 'label' => 'repayment_principle', 'desc' => 'Repayment principle.'],
      'repayment_interest' => ['type' => 'decimal', 'label' => 'repayment_interest', 'desc' => 'Repayment interest.'],
      'amount_sold' => ['type' => 'decimal', 'label' => 'amount_sold', 'desc' => 'Amount sold.'],
    ];
    foreach ($fieldsConfig as $fieldKey => $config) {
      $fields[$fieldKey] = BaseFieldDefinition::create($config['type'])
        ->setLabel(t($config['label']))
        ->setDescription(t("BmBodInvestment " . $config['desc']));
    }

    return $fields;
  }
}