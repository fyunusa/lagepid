<?php

/**
 * Provides an 'IF' action container that executes nested actions based on a condition.
 *
 * @RulesAction(
 *   id = "rules_if_container",
 *   label = @Translation("IF Container"),
 *   category = @Translation("EDAWAH RULES"),
 *   context_definitions = {
 *     "variable_1" = @ContextDefinition("string",
 *       label = @Translation("Variable 1"),
 *       description = @Translation("Specifies variable 1 for the IF condition."),
 *       required = TRUE,
 *     ),
 *     "operator" = @ContextDefinition("string",
 *       label = @Translation("Operator"),
 *       description = @Translation("The comparison operator. Valid values are <, >, ==, !="),
 *       required = TRUE,
 *       default_value = "=="
 *     ),
 *     "variable_2" = @ContextDefinition("string",
 *       label = @Translation("Variable 2"),
 *       description = @Translation("Specifies variable 2 for the IF condition."),
 *       required = TRUE,
 *     ),
 *     "actions" = @ContextDefinition("list:business_rules_action",
 *       label = @Translation("Actions"),
 *       description = @Translation("The list of nested actions inside the IF container."),
 *       required = FALSE,
 *     ),
 *   }
 * )
 */
class IfActionContainer extends RulesActionBase
{

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        // Get the values of the context variables for the condition evaluation.
        $variable_1 = $this->getContextValue('variable_1');
        $operator = $this->getContextValue('operator');
        $variable_2 = $this->getContextValue('variable_2');

        // Perform the condition evaluation based on the operator.
        $condition_result = FALSE;
        if ($operator === '<' && $variable_1 < $variable_2) {
            $condition_result = TRUE;
        } elseif ($operator === '>' && $variable_1 > $variable_2) {
            $condition_result = TRUE;
        } elseif ($operator === '==' && $variable_1 === $variable_2) {
            $condition_result = TRUE;
        } elseif ($operator === '!=' && $variable_1 !== $variable_2) {
            $condition_result = TRUE;
        }

        // If the condition is satisfied, execute the nested actions.
        if ($condition_result) {
            $nested_actions = $this->getContextValue('actions');
            if (is_array($nested_actions)) {
                foreach ($nested_actions as $action) {
                    // Execute the nested action.
                    $action->execute();
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildConfigurationForm(array $form, FormStateInterface $form_state)
    {
        // Render form elements for the condition settings (variable_1, operator, variable_2).
        // ...

        // Render form elements for the nested actions.
        $form['actions'] = [
            '#type' => 'container',
            '#tree' => TRUE,
            '#prefix' => '<div id="actions-container">',
            '#suffix' => '</div>',
        ];

        // Load the nested actions from the context.
        $nested_actions = $this->getContextValue('actions');

        // If no actions are provided, initialize an empty array.
        if (!is_array($nested_actions)) {
            $nested_actions = [];
        }

        // Render form elements for each nested action.
        foreach ($nested_actions as $index => $action) {
            $action_form = $action->buildConfigurationForm([], $form_state);
            $form['actions'][$index] = $action_form;
        }

        // Use a select list for the "Add Action" button to choose from available actions.
        $default_actions = $this->getDefaultRulesActions();
        $options = [];
        foreach ($default_actions as $action_id => $action_label) {
            $options[$action_id] = $action_label;
        }

        $form['actions']['add_action'] = [
            '#type' => 'select',
            '#title' => $this->t('Add Action'),
            '#options' => $options,
            '#empty_option' => $this->t('- Select an action -'),
            '#ajax' => [
                'callback' => '::addActionAjaxCallback',
                'wrapper' => 'actions-container',
            ],
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitConfigurationForm(array &$form, FormStateInterface $form_state)
    {
        // Process the submitted form values.
        // ...

        // Load the nested actions from the form state.
        $nested_actions = $form_state->getValue('actions');

        // Extract the settings for each nested action.
        $actions_settings = [];
        foreach ($nested_actions as $index => $action_id) {
            $action = $this->getPlugin()->getContextValue('actions')->createInstance();
            $action_form = $form['actions'][$index];
            $action->submitConfigurationForm($action_form, $form_state);
            $actions_settings[] = $action;
        }

        // Set the nested actions as the context value.
        $this->setContextValue('actions', $actions_settings);
    }

    /**
     * Submit callback for adding a new nested action.
     */
    public function addActionAjaxCallback(array &$form, FormStateInterface $form_state)
    {
        return $form['actions'];
    }

    /**
     * Helper function to get a list of available default Rules actions.
     *
     * @return array
     *   An array of default Rules actions where keys are action IDs and values are action labels.
     */
    protected function getDefaultRulesActions()
    {
        // Retrieve a list of default Rules actions.
        // You can implement this function to fetch the available default actions dynamically.
        // You may use the RulesActionManager service to get the list of available actions.
        // For example, you can use \Drupal::service('plugin.manager.rules_action')->getDefinitions();
        // to get all available action plugin definitions and then extract their IDs and labels.
        // Replace the following code with the actual implementation to get the list of actions.

        // For example:
        return [
            'rules_send_email' => 'Send email',
            'rules_create_entity' => 'Create entity',
            // Add more action IDs and labels as needed.
        ];
    }
}
