<?php

namespace Drupal\bm_bod\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the BM Bod Investment Log content entity.
 *
 * @ContentEntityType(
 *   id = "bm_bod_investment_log",
 *   label = @Translation("BM Bod Investment Log entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *   },
 *   base_table = "bm_bod_investment_log",
 *   fieldable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "debt_id" = "debt_id",
 *     "investment_id" = "investment_id",
 *     "amount" = "amount",
 *     "start_date" = "start_date",
 *     "close_date" = "close_date",
 *     "transferred_to" = "transferred_to",
 *   },
 * )
 */
class BmBodInvestmentLog extends ContentEntityBase implements ContentEntityInterface {
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fieldsConfig = [
      'id' => ['type' => 'integer', 'label' => 'ID', 'desc' => 'ID'],
      'debt_id' => ['type' => 'integer', 'label' => 'debt_id', 'desc' => 'Debt node that the investment relates to.'],
      'investment_id' => ['type' => 'integer', 'label' => 'The type of account.', 'desc' => 'The nid of the investment.'],
      'amount' => ['type' => 'decimal', 'label' => 'amount', 'desc' =>'Transferred amount of loan.'],
      'start_date' => ['type' => 'integer', 'label' => 'start_date', 'desc' => 'The Unix timestamp when the investment occurred.'],
      'close_date' => ['type' => 'integer', 'label' => 'close_date', 'desc' => 'The Unix timestamp when the investment was transferred or repaid.'],
      'transferred_to' => ['type' => 'integer', 'label' => 'transferred_to', 'desc' => 'investment id that the partial or complete loan was transferred to.'],
    ];
    foreach ($fieldsConfig as $fieldKey => $config) {
      $fields[$fieldKey] = BaseFieldDefinition::create($config['type'])
        ->setLabel(t($config['label']))
        ->setDescription(t("BmBodInvestmentLog " . $config['desc']));
    }

    return $fields;
  }
}