<?php

namespace Drupal\bm_bod\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the BM Bod Secondary Listing content entity.
 *
 * @ContentEntityType(
 *   id = "bm_bod_secondary_listing",
 *   label = @Translation("BM Bod Secondary Listing entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *   },
 *   base_table = "bm_bod_secondary_listing",
 *   fieldable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "investment_id" = "investment_id",
 *     "amount" = "amount",
 *     "listing_date" = "listing_date",
 *     "status" = "status",
 *   },
 * )
 */
class BmBodSecondaryListing extends ContentEntityBase implements ContentEntityInterface {
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fieldsConfig = [
      'id' => ['type' => 'integer', 'label' => 'ID', 'desc' => 'Approval ID.'],
      'investment_id' => ['type' => 'integer', 'label' => 'investment_id', 'desc' => 'The nid of the investment.'],
      'amount' => ['type' => 'decimal', 'precision' => 11, 'label' => 'amount', 'desc' => 'The investment amount.'],
      'listing_date' => ['type' => 'integer', 'label' => 'listing_date', 'desc' => 'The Unix timestamp when the investment occurred.'],
      'status' => ['type' => 'integer', 'label' => 'status', 'desc' => '0 = Active, 1 = Completed, 2 = Cancelled'],
    ];
    foreach ($fieldsConfig as $fieldKey => $config) {
      $fields[$fieldKey] = BaseFieldDefinition::create($config['type'])
        ->setLabel(t($config['label']))
        ->setDescription(t("BmBodSecondaryListing " . $config['desc']));
    }

    $fields['id']->setReadOnly(TRUE);

    return $fields;
  }
}