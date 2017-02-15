<?php

namespace Drupal\bm_bod\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the BM Bod Withdrawl content entity.
 *
 * @ContentEntityType(
 *   id = "bm_bod_withdrawl",
 *   label = @Translation("BM Bod Withdrawl entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *   },
 *   base_table = "bm_bod_withdrawl",
 *   fieldable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "amount" = "amount",
 *     "from_account" = "from_account",
 *     "sortcode" = "sortcode",
 *     "bank_account" = "bank_account",
 *     "requested_date" = "requested_date",
 *     "completed_date" = "completed_date",
 *   },
 * )
 */
class BmBodWithdrawl extends ContentEntityBase implements ContentEntityInterface {
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fieldsConfig = [
      'id' => ['type' => 'integer', 'label' => 'ID', 'desc' => 'ID'],
      'amount' => ['type' => 'decimal', 'precision' => 11, 'label' => 'amount', 'desc' => 'The amount to be withdrawn.'],
      'from_account' => ['type' => 'integer', 'label' => 'from_account.', 'desc' => 'The account to be debited.'],
      'sortcode' => ['type' => 'string', 'label' => 'sortcode', 'desc' =>'Bank account sort code.'],
      'bank_account' => ['type' => 'string', 'label' => 'bank_account', 'desc' => 'Bank account number.'],
      'requested_date' => ['type' => 'integer', 'label' => 'requested_date', 'desc' => 'The Unix timestamp when the investment occurred.'],
      'completed_date' => ['type' => 'integer', 'label' => 'completed_date', 'desc' => 'The Unix timestamp when the investment occurred.'],
    ];
    foreach ($fieldsConfig as $fieldKey => $config) {
      $fields[$fieldKey] = BaseFieldDefinition::create($config['type'])
        ->setLabel(t($config['label']))
        ->setDescription(t("BmBodWithdrawl " . $config['desc']));
    }

    return $fields;
  }
}