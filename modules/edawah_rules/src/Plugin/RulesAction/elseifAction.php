<?php

/**
 * Provides an 'ELSEIF' action that performs an action based on a condition.
 *
 * @RulesAction(
 *   id = "rules_elseif",
 *   label = @Translation("ELSEIF"),
 *   category = @Translation("EDAWAH RULES"),
 *   context_definitions = {
 *     "variable_1" = @ContextDefinition("string",
 *       label = @Translation("Variable 1"),
 *       description = @Translation("Specifies variable 1 for the ELSEIF condition.")
 *     ),
 *     "variable_2" = @ContextDefinition("string",
 *       label = @Translation("Variable 2"),
 *       description = @Translation("Specifies variable 2 for the ELSEIF condition.")
 *     ),
 *   }
 * )
 */
class ElseIfAction extends RulesActionBase {

  /**
   * {@inheritdoc}
   */
  public function execute($variable_1, $variable_2) {
    // Get the form to input the condition.
    $form = \Drupal::formBuilder()->getForm('Drupal\edawah_rules\Form\ElseIfActionForm', $variable_1, $variable_2);

    // Return the form to be displayed in the Rules UI.
    return $form;
  }
}
