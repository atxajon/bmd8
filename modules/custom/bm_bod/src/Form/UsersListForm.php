<?php
/**
 * @file
 * Contains \Drupal\bm_bod\Form\UsersListForm.
 */
namespace Drupal\bm_bod\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * UsersListForm form.
 */
class UsersListForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bm_bod_user_list_filters';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['user_email'] = array(
      '#type' => 'textfield',
      '#title' => 'Search by user email',
      '#size' => '20',
    );

    $form['has_transferred'] = array(
      '#type' => 'details',
      '#title' => 'Has transferred money',
      '#attributes' => array(
        'class' => array(
          'has-transferred',
        ),
      ),
      '#tree' => TRUE,
      '#open' => FALSE,
    );

    $form['has_transferred']['radios'] = array(
      '#type' => 'radios',
      '#options' => array(
        '1'   => t('Yes'),
        '2' => t('No'),
        '0'   => t('N/A'),
      ),
      '#required' => FALSE,
    );

    $form['qty_invested'] = array(
      '#type' => 'details',
      '#title' => 'Has made a total investment of',
      '#attributes' => array(
        'class' => array(
          'qty-invested',
        ),
      ),
      '#tree' => TRUE,
      '#open' => FALSE,
    );
    $form['qty_invested']['min_qty'] = array(
      '#type' => 'textfield',
      '#title' => 'at least',
      '#size' => '20',
    );
    $form['qty_invested']['max_qty'] = array(
      '#type' => 'textfield',
      '#title' => 'up to',
      '#size' => '20',
    );

    // Prepare year list dropdown options.
    $year_options = array();
    $curr_year = date('Y');
    $starting_year = 2015;
    for ($curr_year; $curr_year >= $starting_year; $curr_year--) {
      $year_options[$curr_year] = $curr_year;
    }
    $months = array(
      1 => 1,
      2 => 2,
      3 => 3,
      4 => 4,
      5 => 5,
      6 => 6,
      7 => 7,
      8 => 8,
      9 => 9,
      10 => 10,
      11 => 11,
      12 => 12,
    );

    $form['from'] = array(
      '#type' => 'details',
      '#title' => 'Signed up from',
      '#attributes' => array(
        'class' => array(
          'from-date',
        ),
      ),
      '#tree' => TRUE,
      '#open' => FALSE,
    );
    $form['from']['from_day'] = array(
      '#type' => 'textfield',
      '#title' => t('Day'),
      '#size' => 2,
      '#maxlength' => 2,
    );
    $form['from']['from_month'] = array(
      '#type' => 'select',
      '#title' => t('Month'),
      '#options' => $months,
      "#empty_option" => '-',
    );
    $form['from']['from_year'] = array(
      '#type' => 'select',
      '#title' => t('Year'),
      '#options' => $year_options,
      "#empty_option" => '-',
    );
    $form['to'] = array(
      '#type' => 'details',
      '#title' => t('To'),
      '#attributes' => array(
        'class' => array(
          'to-date',
        ),
      ),
      '#tree' => TRUE,
      '#open' => FALSE,
    );
    $form['to']['to_day'] = array(
      '#type' => 'textfield',
      '#title' => t('Day'),
      '#size' => 2,
      '#maxlength' => 2,
    );
    $form['to']['to_month'] = array(
      '#type' => 'select',
      '#title' => 'Month',
      '#options' => $months,
      "#empty_option" => '-',
    );
    $form['to']['to_year'] = array(
      '#type' => 'select',
      '#title' => t('Year'),
      '#options' => $year_options,
      "#empty_option" => '-',
    );

    $form['invested_from'] = array(
      '#type' => 'details',
      '#title' => t('First time invested between'),
      '#attributes' => array(
        'class' => array(
          'from-date invested-dates',
        ),
      ),
      '#tree' => TRUE,
      '#open' => FALSE,
    );
    $form['invested_from']['from_day'] = array(
      '#type' => 'textfield',
      '#title' => t('Day'),
      '#size' => 2,
      '#maxlength' => 2,
    );
    $form['invested_from']['from_month'] = array(
      '#type' => 'select',
      '#title' => 'Month',
      '#options' => $months,
      "#empty_option" => '-',
    );
    $form['invested_from']['from_year'] = array(
      '#type' => 'select',
      '#title' => t('Year'),
      '#options' => $year_options,
      '#attributes' => array(
        'class' => array(
          'year',
        ),
      ),
      "#empty_option" => '-',
    );
    $form['invested_to'] = array(
      '#type' => 'details',
      '#title' => t('and'),
      '#attributes' => array(
        'class' => array(
          'to-date',
        ),
      ),
      '#tree' => TRUE,
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['invested_to']['to_day'] = array(
      '#type' => 'textfield',
      '#title' => t('Day'),
      '#size' => 2,
      '#maxlength' => 2,
    );
    $form['invested_to']['to_month'] = array(
      '#type' => 'select',
      '#title' => 'Month',
      '#options' => $months,
      "#empty_option" => '-',
    );
    $form['invested_to']['to_year'] = array(
      '#type' => 'select',
      '#title' => t('Year'),
      '#options' => $year_options,
      "#empty_option" => '-',
    );

    $form['times_invested'] = array(
      '#type' => 'details',
      '#title' => t('Times has invested in total'),
      '#attributes' => array(
        'class' => array(
          'times-invested',
        ),
      ),
      '#tree' => TRUE,
      '#open' => FALSE,
    );
    $form['times_invested']['from'] = array(
      '#type' => 'textfield',
      '#title' => t('More than'),
      '#size' => 2,
      '#maxlength' => 2,
    );
    $form['times_invested']['to'] = array(
      '#type' => 'textfield',
      '#title' => t('Up to'),
      '#size' => 2,
      '#maxlength' => 2,
    );
    $form['how_heard'] = array(
      '#type' => 'details',
      '#title' => t('How they heard about us'),
      '#attributes' => array(
        'class' => array(
          'times-invested',
        ),
      ),
      '#tree' => TRUE,
      '#open' => FALSE,
    );

//    $how_heard_field = field_info_field('field_how_did_you_hear_about_us');
//    $how_heard_values = list_allowed_values($how_heard_field);
//    $form['how_heard']['heard_checkboxes'] = array(
//      '#type' => 'checkboxes',
//      '#options' => $how_heard_values,
//      "#empty_option" => '-',
//    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Search',
    );

    $form['html_markup'] = array('#markup' => t('<a class="btn btn-warning" href="/marketing-dashboard">Reset filters - Show all results</a>'));

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

//    $form_state->setMethod('get');
//    $values = $form_state->getValues();
//    $user_email = $form_state->getValue('user_email');

  }
}