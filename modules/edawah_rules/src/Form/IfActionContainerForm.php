<?php

namespace Drupal\edawah_rules\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\rules\Core\RulesActionInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements the IfActionContainerForm form.
 */
class IfActionContainerForm extends FormBase
{

    /**
     * @var \Drupal\rules\Core\RulesActionInterface
     */
    protected $action;

    /**
     * @var \Drupal\Core\Session\AccountProxyInterface
     */
    protected $currentUser;

    /**
     * Class constructor.
     */
    public function __construct(RulesActionInterface $action, AccountProxyInterface $current_user)
    {
        $this->action = $action;
        $this->currentUser = $current_user;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('edawah_rules.if_action_container'), // Adjust the service ID accordingly
            $container->get('current_user')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'if_action_container_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['variable_1'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Variable 1'),
            // ...
        ];

        $form['operator'] = [
            '#type' => 'select',
            '#title' => $this->t('Operator'),
            // Define options for operators (<, >, ==, !=, etc.)
            '#options' => [
                '<' => $this->t('<'),
                '>' => $this->t('>'),
                '==' => $this->t('=='),
                '!=' => $this->t('!='),
            ],
        ];

        $form['variable_2'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Variable 2'),
            // ...
        ];

        // Define the list of available default Rules actions.
        $available_actions = $this->getAvailableDefaultActions();

        foreach ($available_actions as $action_id => $action_label) {
            $form[$action_id] = [
                '#type' => 'checkbox',
                '#title' => $action_label,
                // ...
            ];
        }

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $variable_1 = $form_state->getValue('variable_1');
        $operator = $form_state->getValue('operator');
        $variable_2 = $form_state->getValue('variable_2');

        // Perform the condition check based on the selected operator.
        $condition_met = $this->compareVariables($variable_1, $operator, $variable_2);

        if ($condition_met) {
            $selected_actions = array_filter($form_state->getValues());
            unset($selected_actions['variable_1'], $selected_actions['operator'], $selected_actions['variable_2'], $selected_actions['submit']);

            foreach ($selected_actions as $action_id => $value) {
                if ($value) {
                    // Execute the selected action.
                    $this->executeAction($action_id);
                }
            }
        }
    }

    /**
     * Checks if the condition is met.
     */
    protected function compareVariables($variable_1, $operator, $variable_2)
    {
        switch ($operator) {
            case '<':
                return $variable_1 < $variable_2;
            case '>':
                return $variable_1 > $variable_2;
            case '==':
                return $variable_1 == $variable_2;
            case '!=':
                return $variable_1 != $variable_2;
                // Add more cases for other operators as needed.
        }
        return FALSE;
    }

    /**
     * Get available default Rules actions.
     */
    protected function getAvailableDefaultActions()
    {
        // This is just an example, you should list all available default actions.
        return [
            'publish_content_action' => $this->t('Publish Content'),
            'unpublish_content_action' => $this->t('Unpublish Content'),
            // Add more default action IDs and labels.
        ];
    }

    /**
     * Execute a selected action.
     */
    protected function executeAction($action_id)
    {
        switch ($action_id) {
            case 'publish_content_action':
                // Execute the publish content action.
                $this->action->getPlugin('publish_content_action')->execute();
                break;
            case 'unpublish_content_action':
                // Execute the unpublish content action.
                $this->action->getPlugin('unpublish_content_action')->execute();
                break;
                // Add more cases for other action IDs.
        }
    }
}
