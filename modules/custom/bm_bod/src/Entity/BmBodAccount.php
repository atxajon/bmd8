<?php

namespace Drupal\bm_bod\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the BM Bod Account content entity.
 *
 * @ContentEntityType(
 *   id = "bm_bod_account",
 *   label = @Translation("BM Bod Account entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *   },
 *   base_table = "bm_bod_account",
 *   fieldable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "account_type" = "account_type",
 *     "investment_id" = "investment_id",
 *     "balance" = "balance",
 *     "description" = "description",
 *     "status" = "status",
 *     "changed" = "changed",
 *     "created" = "created",
 *     "owner" = "owner",
 *     "outstanding_fees" = "outstanding_fees",
 *     "approved_amount" = "approved_amount",
 *   },
 * )
 */
class BmBodAccount extends ContentEntityBase implements ContentEntityInterface {
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fieldsConfig = [
      'id' => ['type' => 'integer', 'label' => 'ID', 'desc' => 'ID'],
      'account_type' => ['type' => 'string', 'label' => 'The type of account.', 'desc' => 'name'],
      'investment_id' => ['type' => 'integer', 'label' => 'investment_id', 'desc' => 'Node ID of the investment node associated with the account.'],
      'balance' => ['type' => 'decimal', 'label' => 'balance', 'desc' => 'The value of the account.'],
      'description' => ['type' => 'string', 'label' => 'description', 'desc' => 'Account name.'],
      'status' => ['type' => 'integer', 'label' => 'status', 'desc' => 'Boolean indicating whether the account is open or closed.'],
      'changed' => ['type' => 'integer', 'label' => 'changed', 'desc' => 'The Unix timestamp when the account was changed.'],
      'created' => ['type' => 'integer', 'label' => 'created', 'desc' => 'The Unix timestamp when the node was created.'],
      'owner' => ['type' => 'integer', 'label' => 'owner', 'desc' => 'The uid of the owner account.'],
      'outstanding_fees' => ['type' => 'decimal', 'label' => 'outstanding_fees', 'desc' => 'Outstanding BM fees.'],
      'approved_amount' => ['type' => 'decimal', 'label' => 'approved_amount', 'desc' => 'Amount they are currently looking to invest, this is set when the investment form is filled in.'],
    ];
    foreach ($fieldsConfig as $fieldKey => $config) {
      $fields[$fieldKey] = BaseFieldDefinition::create($config['type'])
        ->setLabel(t($config['label']))
        ->setDescription(t("BmBodAccount " . $config['desc']));
    }

    $fields['id']->setReadOnly(TRUE);

    return $fields;
  }
}