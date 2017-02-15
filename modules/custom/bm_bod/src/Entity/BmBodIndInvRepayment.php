<?php


namespace Drupal\bm_bod\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the BM Bod Ind Inv Repayment content entity. Refers to the record of
 * investment by each investor into debt.
 *
 * @ContentEntityType(
 *   id = "bm_bod_ind_inv_repayment",
 *   label = @Translation("BM Bod Ind Inv Repayment entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *   },
 *   base_table = "bm_bod_ind_inv_repayment",
 *   fieldable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "inv_record_id" = "inv_record_id",
 *     "investment_amount" = "investment_amount",
 *     "repayment_principle" = "repayment_principle",
 *     "repayment_interest" = "repayment_interest",
 *     "repayment_date" = "repayment_date",
 *     "interest_rate" = "interest_rate",
 *     "repayment_id" = "repayment_id",
 *   },
 * )
 */
class BmBodIndInvRepayment extends ContentEntityBase implements ContentEntityInterface {
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fieldsConfig = [
      'id' => ['type' => 'integer', 'label' => 'ID', 'desc' => 'ID'],
      'inv_record_id' => ['type' => 'string', 'label' => 'inv_record_id', 'desc' => 'The id of the investment entity.'],
      'investment_amount' => ['type' => 'decimal', 'precision' => 11, 'label' => 'investment_amount', 'desc' =>'The investment amount.'],
      'repayment_principle' => ['type' => 'decimal', 'precision' => 11, 'label' => 'repayment_principle', 'desc' => 'Repayment principle.'],
      'repayment_interest' => ['type' => 'decimal', 'precision' => 11, 'label' => 'repayment_interest', 'desc' => 'Repayment interest.'],
      'repayment_date' => ['type' => 'integer', 'label' => 'repayment_date', 'desc' => 'The Unix timestamp when the investment occurred.'],
      'interest_rate' => ['type' => 'integer', 'label' => 'interest_rate', 'desc' => 'The interest rate of the loan.'],
      'repayment_id' => ['type' => 'integer', 'label' => 'repayment_id', 'desc' => 'The ID of the repayment record.'],
    ];
    foreach ($fieldsConfig as $fieldKey => $config) {
      $fields[$fieldKey] = BaseFieldDefinition::create($config['type'])
        ->setLabel(t($config['label']))
        ->setDescription(t("BmBodIndInvRepayment " . $config['desc']));
    }
    return $fields;
  }
}
