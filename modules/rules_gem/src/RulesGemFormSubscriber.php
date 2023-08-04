<?php

namespace Drupal\rules_gem;

use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\rules\Core\RulesConditionInterface;

/**
 * Event subscriber for embedding the nested actions UI.
 */
class RulesGemFormSubscriber implements EventSubscriberInterface
{

    /**
     * Implements hook_form_FORM_ID_alter() for the Rules IF container form.
     */
    public function alterRulesConfigIfForm(array &$form, FormStateInterface $form_state, $form_id)
    {
        // Get the current action configuration.
        $action = $form_state->getFormObject()->getConfiguration();

        // Check if the action is our custom IF action.
        if ($action instanceof RulesConditionInterface && $action->getPluginId() === 'rules_gem_if_action') {
            // Embed the form for managing the nested actions within the IF action form.
            $action_set = rules_action_set('rules_gem_action_set');
            $options = ['show settings' => TRUE, 'button' => TRUE];
            $action_set->form($form, $form_state, $options);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'rules_form_event_alter' => 'alterRulesConfigIfForm',
        ];
    }
}
