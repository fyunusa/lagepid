<?php

namespace Drupal\edawah_rules\Plugin\RulesExpression;

use Drupal\rules\Context\ReactionContextDefinitionBase;
use Drupal\rules\Context\ReactionContextDefinitionInterface;

/**
 * Custom context definition for 'rules_if_container'.
 */
class RulesIfContainerContextDefinition extends ReactionContextDefinitionBase implements ReactionContextDefinitionInterface
{

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->t('IF Container');
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->t('The container for nested IF actions.');
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultValueLiteral()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getEmptyContext()
    {
        return new NullContext($this);
    }

    /**
     * {@inheritdoc}
     */
    public function isMultiple()
    {
        return TRUE;
    }
}
