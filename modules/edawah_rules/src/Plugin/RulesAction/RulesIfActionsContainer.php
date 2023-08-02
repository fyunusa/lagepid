<?php

namespace Drupal\edawah_rules\Plugin\RulesAction;

use Drupal\rules\Context\ContextInterface;
use Drupal\Core\TypedData\TypedDataInterface;
use Drupal\Core\TypedData\TypedDataTrait;
use Drupal\Core\Plugin\Context\ContextDefinitionInterface;

/**
 * Provides the custom context for the nested actions inside the IF container.
 */
class RulesIfActionsContainer implements ContextInterface, ContextDefinitionInterface
{
    use TypedDataTrait;

    /**
     * The context value.
     *
     * @var array
     */
    protected $value;

    /**
     * {@inheritdoc}
     */
    public static function create()
    {
        return new static();
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
    public function getDataType()
    {
        return 'rules_if_actions_container_type'; // Use a unique data type name.
    }

    /**
     * {@inheritdoc}
     */
    public function setContextDefinition(ContextDefinitionInterface $context_definition)
    {
        $this->definition = $context_definition;
    }

    /**
     * {@inheritdoc}
     */
    public function getContextDefinition()
    {
        return $this->definition;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return empty($this->value);
    }

    // You can implement other methods as needed, but these are the essential ones.
}
