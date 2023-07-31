<?php

// namespace Drupal\edawah_rules\Plugin\RulesAction;

// use Drupal\Core\Form\FormStateInterface;
// use Drupal\rules\Core\RulesActionBase;
// use Drupal\rules\Core\RulesConditionBase;

// /**
//  * Provides an 'IF' action container that executes nested actions based on a condition.
//  *
//  * @RulesAction(
//  *   id = "rules_if_container",
//  *   label = @Translation("IF Container"),
//  *   category = @Translation("EDAWAH RULES"),
//  *   context_definitions = {
//  *     "variable_1" = @ContextDefinition("string",
//  *       label = @Translation("Variable 1"),
//  *       description = @Translation("Specifies variable 1 for the IF condition."),
//  *       required = TRUE,
//  *     ),
//  *     "operator" = @ContextDefinition("string",
//  *       label = @Translation("Operator"),
//  *       description = @Translation("The comparison operator. Valid values are <, >, ==, !="),
//  *       required = TRUE,
//  *       default_value = "=="
//  *     ),
//  *     "variable_2" = @ContextDefinition("string",
//  *       label = @Translation("Variable 2"),
//  *       description = @Translation("Specifies variable 2 for the IF condition."),
//  *       required = TRUE,
//  *     ),
//  *     "actions" = @ContextDefinition("rules_if_container_actions",
//  *       label = @Translation("Nested Actions"),
//  *       description = @Translation("The nested actions inside the IF container."),
//  *       multiple = TRUE,
//  *       required = FALSE,
//  *     ),
//  *   }
//  * )
//  */
// class IfActionContainer extends RulesActionBase
// {

//     /**
//      * {@inheritdoc}
//      */
//     public function execute()
//     {
//         // Get the values of the context variables for the condition evaluation.
//         $variable_1 = $this->getContextValue('variable_1');
//         $operator = $this->getContextValue('operator');
//         $variable_2 = $this->getContextValue('variable_2');

//         // Perform the condition evaluation based on the operator.
//         $condition_result = FALSE;
//         if ($operator === '<' && $variable_1 < $variable_2) {
//             $condition_result = TRUE;
//         } elseif ($operator === '>' && $variable_1 > $variable_2) {
//             $condition_result = TRUE;
//         } elseif ($operator === '==' && $variable_1 === $variable_2) {
//             $condition_result = TRUE;
//         } elseif ($operator === '!=' && $variable_1 !== $variable_2) {
//             $condition_result = TRUE;
//         }

//         // If the condition is satisfied, execute the nested actions.
//         if ($condition_result) {
//             $nested_actions = $this->getContextValue('actions');
//             if (is_array($nested_actions)) {
//                 foreach ($nested_actions as $action) {
//                     // Execute the nested action.
//                     $action->execute();
//                 }
//             }
//         }
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function buildConfigurationForm(array $form, FormStateInterface $form_state)
//     {
//         $form['actions'] = [
//             '#type' => 'container',
//             '#tree' => TRUE,
//             '#prefix' => '<div id="actions-container">',
//             '#suffix' => '</div>',
//         ];

//         $nested_actions = $this->getContextValue('actions');
//         if (!is_array($nested_actions)) {
//             $nested_actions = [];
//         }

//         // Render form elements for each nested action.
//         foreach ($nested_actions as $index => $action) {
//             $action_form = $action->buildConfigurationForm([], $form_state);
//             $form['actions'][$index] = $action_form;
//         }

//         // Use a custom element type for the "Add Action" button.
//         $form['actions']['add_action'] = [
//             '#type' => 'rules_if_add_action', // Custom element type for the button.
//             '#value' => $this->t('Add Action'),
//             '#ajax' => [
//                 'callback' => '::addActionAjaxCallback',
//                 'wrapper' => 'actions-container',
//             ],
//         ];

//         return $form;
//     }

//     /**
//      * Submit callback for adding a new nested action.
//      */
//     public function addAction(array &$form, FormStateInterface $form_state)
//     {
//         // Check if the "Add Action" button is clicked.
//         if ($form_state->getTriggeringElement()['#type'] == 'rules_if_add_action') {
//             $actions = $form_state->getValue('actions');
//             $actions[] = $this->getPlugin()->getContextValue('actions')->createInstance();
//             $form_state->setValue('actions', $actions);
//             $form_state->setRebuild(TRUE);
//         }
//     }

//     /**
//      * Ajax callback for adding a new nested action.
//      */
//     public function addActionAjaxCallback(array &$form, FormStateInterface $form_state)
//     {
//         return $form['actions'];
//     }
// }
