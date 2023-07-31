<?php

// namespace Drupal\edawah_rules\Condition;

// use Drupal\rules\Core\RulesConditionBase;
// use Drupal\Core\Form\FormStateInterface;

// /**
//  * Provides a custom rules condition for Edawah Rules.
//  *
//  * @Condition(
//  *   id = "edawah_rules_condition",
//  *   label = @Translation("Edawah Rules Condition"),
//  *   category = @Translation("EDAWAH RULES"),
//  *   context_definitions = {
//  *     "variable_1" = @ContextDefinition("string",
//  *       label = @Translation("Variable 1"),
//  *       description = @Translation("Specifies variable 1 for the condition."),
//  *       required = TRUE,
//  *     ),
//  *     "operator" = @ContextDefinition("string",
//  *       label = @Translation("Operator"),
//  *       description = @Translation("The comparison operator. Valid values are <, >, ==, !="),
//  *       required = TRUE,
//  *     ),
//  *     "variable_2" = @ContextDefinition("string",
//  *       label = @Translation("Variable 2"),
//  *       description = @Translation("Specifies variable 2 for the condition."),
//  *       required = TRUE,
//  *     ),
//  *   }
//  * )
//  */
// class EdawahRulesCondition extends RulesConditionBase
// {

//     /**
//      * {@inheritdoc}
//      */
//     public function evaluate()
//     {
//         // Get the values of the context variables for the condition evaluation.
//         $variable_1 = $this->getContextValue('variable_1');
//         $operator = $this->getContextValue('operator');
//         $variable_2 = $this->getContextValue('variable_2');

//         // Perform the condition evaluation based on the operator.
//         switch ($operator) {
//             case '<':
//                 return $variable_1 < $variable_2;
//             case '>':
//                 return $variable_1 > $variable_2;
//             case '==':
//                 return $variable_1 == $variable_2;
//             case '!=':
//                 return $variable_1 != $variable_2;
//         }

//         // Return FALSE if the operator is not valid.
//         return FALSE;
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function buildConfigurationForm(array $form, FormStateInterface $form_state)
//     {
//         // Build the configuration form elements for the condition here (if needed).
//         return $form;
//     }
// }
