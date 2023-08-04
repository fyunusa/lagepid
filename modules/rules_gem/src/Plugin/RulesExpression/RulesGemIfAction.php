<?php
// rules_gem/src/Plugin/RulesExpression/RulesGemIfAction.php

namespace Drupal\rules_gem\Plugin\RulesExpression;

use Drupal\Core\Form\FormStateInterface;
use Drupal\rules\Core\RulesActionBase;
use Drupal\rules\Core\RulesConditionInterface;

/**
 * Provides a custom IF Action with nested actions for Rules.
 *
 * @RulesAction(
 *   id = "rules_gem_if_action",
 *   label = @Translation("Custom IF Action"),
 *   category = @Translation("Custom"),
 *   context_definitions = {
 *     "node" = @ContextDefinition("entity:node",
 *       label = @Translation("Node"),
 *       description = @Translation("The node to check."),
 *       required = TRUE,
 *     ),
 *   }
 * )
 */
class RulesGemIfAction extends RulesConditionBase
{

    /**
     * Executes the IF action.
     */
    public function execute()
    {
        $node = $this->getContextValue('node');
        if ($node->bundle() === 'article') {
            // Execute nested actions here.
            $this->executeNestedActions();
        }
    }
}
