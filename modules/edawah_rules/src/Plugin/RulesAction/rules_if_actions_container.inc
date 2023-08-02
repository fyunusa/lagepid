<?php

namespace Drupal\edawah_rules\Plugin\RulesAction;

use Drupal\Core\Plugin\Context\ContextDefinition;
use Drupal\Core\Plugin\Context\ContextDefinitionInterface;

/**
 * Provides the custom context definition for the nested actions inside the IF container.
 */
class RulesIfActionsContainer extends ContextDefinition implements ContextDefinitionInterface
{

    /**
     * {@inheritdoc}
     */
    public static function create()
    {
        return new static(
            'rules_if_actions_container_type',
            t('Nested Actions'),
            FALSE,
            FALSE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataType()
    {
        return 'any'; // Modify the data type according to your needs.
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return t('Nested Actions');
    }

    /**
     * {@inheritdoc}
     */
    public function isRequired()
    {
        return FALSE; // Modify if the context is required.
    }

    /**
     * {@inheritdoc}
     */
    public function allowsMultiple()
    {
        return TRUE; // Modify if the context allows multiple values.
    }
}
