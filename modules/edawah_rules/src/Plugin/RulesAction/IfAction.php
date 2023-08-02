<?php

namespace Drupal\edawah_rules\Plugin\RulesAction;

use Drupal\Core\Form\FormStateInterface;
use Drupal\rules\Core\RulesActionBase;

/**
 * Provides an 'IF' action that performs an action based on a condition.
 *
 * @RulesAction(
 *   id = "rules_if",
 *   label = @Translation("IF"),
 *   category = @Translation("EDAWAH RULES"),
 *   context_definitions = {
 *     "variable_1" = @ContextDefinition("string",
 *       label = @Translation("Variable 1"),
 *       description = @Translation("Specifies variable 1 for the IF condition."),
 *       required = TRUE,
 *     ),
 *     "operator" = @ContextDefinition("string",
 *       label = @Translation("Operator"),
 *       description = @Translation("The comparison operator. Valid values are <, >, ==, !="),
 *       required = TRUE,
 *     ),
 *     "variable_2" = @ContextDefinition("string",
 *       label = @Translation("Variable 2"),
 *       description = @Translation("Specifies variable 2 for the IF condition."),
 *       required = TRUE,
 *     ),
 *   },
 *   provides = {
 *     "rules_if_container" = @ContextDefinition("rules_if_container",
 *       label = @Translation("IF Container"),
 *       description = @Translation("The container for nested IF actions."),
 *     )
 *   }
 * )
 */
class IfAction extends RulesActionBase
{

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        // Get the values of the context variables.
        $variable_1 = $this->getContextValue('variable_1');
        $operator = $this->getContextValue('operator');
        $variable_2 = $this->getContextValue('variable_2');

        // Perform your desired actions based on the values of the context variables.
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
        } elseif ($operator === '!=' && $variable_1 !== $variable_2) {
            // Perform the action when Variable 1 is not equal to Variable 2.
            // Add your action logic here.
        }

        // Execute nested actions inside the IF container.
        $this->executeNestedActions();
    }

    /**
     * Executes nested actions.
     */
    protected function executeNestedActions()
    {
        // Get the nested actions added by the user in the Rules UI.
        $nested_actions = $this->getSubactions();

        // Execute each nested action.
        foreach ($nested_actions as $action) {
            $action->execute();
        }
    }
}




//------------------------------Working-------------------------//
// namespace Drupal\edawah_rules\Plugin\RulesAction;

// use Drupal\Core\Form\FormStateInterface;
// use Drupal\rules\Core\RulesActionBase;

// /**
//  * Provides an 'IF' action that performs an action based on a condition.
//  *
//  * @RulesAction(
//  *   id = "rules_if",
//  *   label = @Translation("IF"),
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
//  *     ),
//  *     "variable_2" = @ContextDefinition("string",
//  *       label = @Translation("Variable 2"),
//  *       description = @Translation("Specifies variable 2 for the IF condition."),
//  *       required = TRUE,
//  *     ),
//  *   },
//  *   provides = {
//  *     "rules_if_container" = @ContextDefinition("rules_if_container",
//  *       label = @Translation("IF Container"),
//  *       description = @Translation("The container for nested IF actions."),
//  *     )
//  *   }
//  * )
//  */

// class IfAction extends RulesActionBase
// {

//   /**
//    * {@inheritdoc}
//    */
//   public function execute()
//   {
//     // Get the values of the context variables.
//     $variable_1 = $this->getContextValue('variable_1');
//     $operator = $this->getContextValue('operator');
//     $variable_2 = $this->getContextValue('variable_2');

//     // Perform your desired actions based on the values of the context variables.
//     // For example:
//     if ($operator === '<' && $variable_1 < $variable_2) {
//       // Perform the action when Variable 1 is less than Variable 2.
//       // Add your action logic here.
//     } elseif ($operator === '>' && $variable_1 > $variable_2) {
//       // Perform the action when Variable 1 is greater than Variable 2.
//       // Add your action logic here.
//     } elseif ($operator === '==' && $variable_1 === $variable_2) {
//       // Perform the action when Variable 1 is equal to Variable 2.
//       // Add your action logic here.
//     } elseif ($operator === '!=' && $variable_1 !== $variable_2) {
//       // Perform the action when Variable 1 is not equal to Variable 2.
//       // Add your action logic here.
//     }

//     // Execute nested actions inside the IF container.
//     $this->executeNestedActions();
//   }

//   /**
//    * Executes nested actions.
//    */
//   protected function executeNestedActions()
//   {
//     // Get the nested actions added by the user in the Rules UI.
//     $nested_actions = $this->getSubactions();

//     // Execute each nested action.
//     foreach ($nested_actions as $action) {
//       $action->execute();
//     }
//   }
// }
