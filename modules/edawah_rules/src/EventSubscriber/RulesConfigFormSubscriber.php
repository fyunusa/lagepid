<?php
// edawah_rules/src/EventSubscriber/RulesConfigFormSubscriber.php

namespace Drupal\edawah_rules\EventSubscriber;

use Drupal\Core\Form\FormStateInterface;
use Drupal\rules\Form\ReactionRuleForm;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Subscriber for altering the Rules configuration form.
 */
class RulesConfigFormSubscriber implements EventSubscriberInterface
{

    /**
     * Alters the Rules configuration form.
     */
    public function alterRulesConfigForm(FilterResponseEvent $event)
    {
        $form = &$event->getResponse()->getContent();
        if (strpos($form, 'rules_config_edit_form') !== false) {
            // Add a custom section to the Rules configuration form.
            $form['custom_section'] = array(
                '#type' => 'fieldset',
                '#title' => t('Custom Section'),
                '#collapsible' => TRUE,
                '#collapsed' => FALSE,
                '#weight' => 99, // Adjust the weight to control the section's position.
            );

            // Add fields within the custom section.
            $form['custom_section']['custom_field'] = array(
                '#type' => 'textfield',
                '#title' => t('Custom Field'),
                '#default_value' => '',
                '#description' => t('This is a custom field in the custom section.'),
                // Add more properties as needed for your custom field.
            );

            // You can add more elements to the custom section as required.
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        $events[KernelEvents::RESPONSE][] = ['alterRulesConfigForm'];
        return $events;
    }
}
