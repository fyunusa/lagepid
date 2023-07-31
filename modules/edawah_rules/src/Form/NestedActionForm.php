<?php

namespace Drupal\your_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\rules\Context\ContextConfig;
use Drupal\rules\Context\ContextDefinition;
use Drupal\rules\Engine\ActionExpressionContainerInterface;
use Drupal\rules\Engine\ActionExpressionInterface;
use Drupal\rules\Engine\ActionExpressionManager;
use Drupal\rules\Plugin\RulesExpression\RulesAction;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form to select and configure nested actions.
 */
class NestedActionForm extends FormBase
{

    /**
     * The action expression manager service.
     *
     * @var \Drupal\rules\Engine\ActionExpressionManager
     */
    protected $actionExpressionManager;

    /**
     * Constructs a new NestedActionForm object.
     *
     * @param \Drupal\rules\Engine\ActionExpressionManager $action_expression_manager
     *   The action expression manager.
     */
    public function __construct(ActionExpressionManager $action_expression_manager)
    {
        $this->actionExpressionManager = $action_expression_manager;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('plugin.manager.rules_expression')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'nested_action_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // Load all available default actions.
        $default_actions = $this->actionExpressionManager->getDefaultActions();
        $action_options = [];

        /** @var \Drupal\rules\Engine\ActionExpressionInterface $action */
        foreach ($default_actions as $action_id => $action) {
            $action_options[$action_id] = $action->getLabel();
        }

        $form['actions'] = [
            '#type' => 'container',
            '#tree' => TRUE,
        ];

        $form['actions']['action_select'] = [
            '#type' => 'select',
            '#title' => $this->t('Select Action'),
            '#options' => $action_options,
            '#empty_option' => $this->t('- Select -'),
            '#ajax' => [
                'callback' => '::ajaxActionSettings',
                'wrapper' => 'action-settings-wrapper',
            ],
        ];

        $form['actions']['action_settings'] = [
            '#type' => 'container',
            '#prefix' => '<div id="action-settings-wrapper">',
            '#suffix' => '</div>',
        ];

        // If there is a selected action, add the settings form elements.
        $selected_action = $form_state->getValue(['actions', 'action_select']);
        if (!empty($selected_action)) {
            $action_instance = $this->actionExpressionManager->createInstance($selected_action);

            $action_settings_form = $action_instance->buildConfigurationForm([], $form_state);
            $form['actions']['action_settings'] = $action_settings_form;
        }

        $form['actions']['add_action'] = [
            '#type' => 'submit',
            '#value' => $this->t('Add Action'),
            '#submit' => ['::addAction'],
            '#ajax' => [
                'callback' => '::ajaxAddAction',
                'wrapper' => 'actions-container',
            ],
        ];

        return $form;
    }

    /**
     * Submit callback for adding a new nested action.
     */
    public function addAction(array &$form, FormStateInterface $form_state)
    {
        $actions = $form_state->getValue(['actions', 'nested_actions']);
        $actions[] = [
            'action_select' => '',
            'action_settings' => [],
        ];
        $form_state->setValue(['actions', 'nested_actions'], $actions);
        $form_state->setRebuild(TRUE);
    }

    /**
     * Ajax callback for adding a new nested action.
     */
    public function ajaxAddAction(array &$form, FormStateInterface $form_state)
    {
        return $form['actions'];
    }

    /**
     * Ajax callback to render action settings based on selected action.
     */
    public function ajaxActionSettings(array &$form, FormStateInterface $form_state)
    {
        return $form['actions']['action_settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // Handle the submitted nested actions here.
        $nested_actions = $form_state->getValue(['actions', 'nested_actions']);

        foreach ($nested_actions as $index => $nested_action) {
            $action_id = $nested_action['action_select'];

            // Create an instance of the selected action.
            $action_instance = $this->actionExpressionManager->createInstance($action_id);

            // Get the settings for the action.
            $action_settings = $nested_action['action_settings'];

            // Save or process the nested action based on your use case.
            // For example, you can store them as configuration or process them immediately.
            // You can also execute the nested actions inside the IF container.
        }
    }
}
