<?php

namespace Drupal\edawah_rules\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for the 'IF' action.
 */
class IfActionForm extends FormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'if_action_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $variable_1 = NULL, $variable_2 = NULL)
  {
    $form['variable_1'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Variable 1'),
      '#default_value' => $variable_1,
      '#required' => TRUE,
    ];

    $form['operator'] = [
      '#type' => 'select',
      '#title' => $this->t('Comparison Operator'),
      '#options' => [
        '<' => $this->t('Less than'),
        '>' => $this->t('Greater than'),
        '==' => $this->t('Equal to'),
      ],
      '#required' => TRUE,
    ];

    $form['variable_2'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Variable 2'),
      '#default_value' => $variable_2,
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // Get the values of the form elements.
    $variable_1 = $form_state->getValue('variable_1');
    $operator = $form_state->getValue('operator');
    $variable_2 = $form_state->getValue('variable_2');

    // Perform your desired actions based on the values of the form elements.
    // For example:
    if ($operator === '<' && $variable_1 < $variable_2) {
      // Perform the action when Variable 1 is less than Variable 2.
      // Add your action logic here.
    } elseif ($operator === '>' && $variable_1 > $variable_2) {
      // Perform the action when Variable 1 is greater than Variable 2.
      // Add your action logic here.
    } elseif ($operator === '==' && $variable_1 === $variable_2) {
      // Perform the action when Variable 1 is equal to Variable 2.
      // Add your action logic here.
    }
  }
}
