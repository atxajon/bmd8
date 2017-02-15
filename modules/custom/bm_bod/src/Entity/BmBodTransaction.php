<?php

namespace Drupal\bm_bod\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the BM Bod Transaction content entity.
 *
 * @ContentEntityType(
 *   id = "bm_bod_transaction",
 *   label = @Translation("BM Bod Transaction entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *   },
 *   base_table = "bm_bod_transaction",
 *   fieldable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "from_account" = "from_account",
 *     "from_account_balance" = "from_account_balance",
 *     "to_account" = "to_account",
 *     "to_account_balance" = "to_account_balance",
 *     "transaction_amount" = "transaction_amount",
 *     "transaction_date" = "transaction_date",
 *     "type" = "type",
 *   },
 * )
 */
class BmBodTransaction extends ContentEntityBase implements ContentEntityInterface {
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fieldsConfig = [
      'id' => ['type' => 'integer', 'label' => 'ID', 'desc' => 'ID'],
      'from_account' => ['type' => 'integer', 'label' => 'from_account', 'desc' => 'The account to be debited.'],
      'from_account_balance' => ['type' => 'decimal', 'precision' => 11, 'label' => 'from_account_balance', 'desc' => 'The value of the account before the debit.'],
      'to_account' => ['type' => 'integer', 'label' => 'to_account', 'desc' => 'The account to be credited.'],
      'to_account_balance' => ['type' => 'decimal', 'precision' => 11, 'label' => 'to_account_balance', 'desc' => 'The value of the account before the credit.'],
      'transaction_amount' => ['type' => 'decimal', 'precision' => 11, 'label' => 'transaction_amount', 'desc' => 'The value of the transaction.'],
      'transaction_date' => ['type' => 'integer', 'label' => 'changed', 'desc' => 'The Unix timestamp when the account was changed.'],
      'type' => ['type' => 'integer', 'label' => 'created', 'desc' => 'Type of transaction.'],
    ];
    foreach ($fieldsConfig as $fieldKey => $config) {
      $fields[$fieldKey] = BaseFieldDefinition::create($config['type'])
        ->setLabel(t($config['label']))
        ->setDescription(t("BmBodTransaction " . $config['desc']));
    }

    $fields['id']->setReadOnly(TRUE);

    return $fields;
  }
}