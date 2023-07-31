<?php


namespace Drupal\edawah_rules\Element;

use Drupal\Core\Render\Element\Button;

/**
 * Provides a custom element for the "Add Action" button.
 *
 * @FormElement("rules_if_add_action")
 */
class RulesIfAddActionElement extends Button
{

    /**
     * {@inheritdoc}
     */
    public function getInfo()
    {
        $class = get_class($this);
        return [
            '#input' => TRUE,
            '#name' => NULL,
            '#value' => NULL,
            '#parents' => [],
            '#ajax' => [],
            '#button_type' => 'submit',
            '#executes_submit_callback' => TRUE,
            '#limit_validation_errors' => [],
            '#process' => [
                [$class, 'processButton'],
            ],
            '#pre_render' => [
                [$class, 'preRenderButton'],
            ],
            '#theme_wrappers' => ['container'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function preRenderButton($element)
    {
        $element = parent::preRenderButton($element);
        // Customize the button attributes as needed.
        $element['#attributes']['class'][] = 'rules-if-add-action-button';
        $element['#attributes']['data-action-type'] = 'add_action'; // Custom attribute to identify the action type.
        return $element;
    }
}
