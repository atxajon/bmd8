<?php

namespace Drupal\bm_bod\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the BM Bod Secondary Listing Log content entity.
 *
 * @ContentEntityType(
 *   id = "bm_bod_secondary_listing_log",
 *   label = @Translation("BM Bod Secondary Listing Log entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *   },
 *   base_table = "bm_bod_secondary_listing_log",
 *   fieldable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "secondary_listing_id" = "secondary_listing_id",
 *     "buyer_uid" = "buyer_uid",
 *     "amount_paid" = "amount_paid",
 *     "investment_amount" = "investment_amount",
 *     "investment_date" = "investment_date",
 *     "status" = "status",
 *   },
 * )
 */
class BmBodSecondaryListingLog extends ContentEntityBase implements ContentEntityInterface {
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fieldsConfig = [
      'id' => ['type' => 'integer', 'label' => 'ID', 'desc' => 'Approval ID.'],
      'secondary_listing_id' => ['type' => 'integer', 'label' => 'secondary_listing_id', 'desc' => 'The id of the secondary listing.'],
      'buyer_uid' => ['type' => 'integer', 'label' => 'buyer_uid', 'desc' => 'The id of the secondary listing.'],
      'amount_paid' => ['type' => 'decimal', 'precision' => 11, 'label' => 'amount_paid', 'desc' => 'The anount paid for the investment this may differ + or - from the value of the investment.'],
      'investment_amount' => ['type' => 'decimal', 'precision' => 11, 'label' => 'investment_amount', 'desc' => 'The investment amount.'],
      'investment_date' => ['type' => 'integer', 'label' => 'investment_date', 'desc' => 'The Unix timestamp when the investment occurred.'],
      'status' => ['type' => 'integer', 'label' => 'status', 'desc' => 'Investment status: 0 = pending, 1 = closed, 2 = completed'],
    ];
    foreach ($fieldsConfig as $fieldKey => $config) {
      $fields[$fieldKey] = BaseFieldDefinition::create($config['type'])
        ->setLabel(t($config['label']))
        ->setDescription(t("BmBodSecondaryListingLog " . $config['desc']));
    }

    $fields['id']->setReadOnly(TRUE);

    return $fields;
  }
}