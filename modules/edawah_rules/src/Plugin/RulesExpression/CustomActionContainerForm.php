<?php

// // my_module/src/Form/Expression/CustomActionContainerForm.php
// namespace Drupal\edawah_rules\Form\Expression;

// use Drupal\Core\Form\FormStateInterface;
// use Drupal\rules\Form\Expression\ActionContainerForm;

// /**
//  * Form handler for action containers with custom buttons.
//  */
// class CustomActionContainerForm extends ActionContainerForm {

//   /**
//    * {@inheritdoc}
//    */
//   public function form(array $form, FormStateInterface $form_state) {
//     $form = parent::form($form, $form_state);

//     // Add custom buttons inside the action container form.
//     $form['custom_buttons'] = [
//       '#type' => 'container',
//       '#attributes' => ['class' => ['custom-action-buttons']],
//     ];

//     $form['custom_buttons']['if'] = [
//       '#type' => 'submit',
//       '#value' => $this->t('IF'),
//       '#submit' => ['::addConditionCallback'],
//       '#name' => 'if_button',
//       '#ajax' => [
//         'callback' => '::addConditionAjaxCallback',
//         'wrapper' => 'actions-table',
//       ],
//     ];

//     // Add the "Custom" category to the actions dropdown.
//     $form['actions']['#options']['custom'] = $this->t('Custom');

//     return $form;
//   }

//   // Rest of the code...

// }
