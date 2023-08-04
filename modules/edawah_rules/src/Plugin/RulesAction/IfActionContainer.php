<?php

namespace Drupal\edawah_rules\Plugin\RulesAction;

use Drupal\edawah_rules\Form\Expression\EdawahActionForm;
use Drupal\edawah_rules\Form\Expression\EdawahActionContainerForm;
use Drupal\edawah_rules\Form\IfActionContainerForm;
use Drupal\rules\Core\RulesActionInterface;
use Drupal\rules\Plugin\RulesExpression\RulesAction;
use Drupal\rules\Core\RulesActionBase;
use Drupal\rules\Core\RulesConditionBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

use Psr\Log\LoggerInterface;



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
 *   }
 * )
 */
class IfActionContainer extends RulesConditionBase implements RulesActionInterface
{

    protected $subactions = [];
    protected $logger;

    /**
     * {@inheritdoc}
     */
    public function autoSaveContext()
    {
        // Per default no context parameters will be auto saved.
        return [];
        // $this->logger->notice('Valid condition: @valid_condition', ['@valid_condition' => 'autosavecontext executed']);
        \Drupal::logger('ifActionContainer')->notice('autosavecontext executed');
    }


    /**
     * {@inheritdoc}
     */
    public function doExecute()
    {
        \Drupal::logger('ifActionContainer')->notice('doExecute executed');

        $valid_condition = $this->compare_variables();
        if ($valid_condition) {
            $this->executeNestedActions();
        }
    }

    /**
     * Show the custom form for nested actions when condition is met.
     */
    protected function showIfActionContainerForm()
    {

        $this->logger->info('Valid condition: @valid_condition', ['@valid_condition' => 'showIfActionContainerForm executed']);

        // Create an instance of the IfActionContainerForm.
        $form_object = new IfActionContainerForm($this, \Drupal::formBuilder(), \Drupal::entityManager());

        // Display the form.
        return $form_object->getForm();
    }

    /**
     * {@inheritdoc}
     */
    public function compare_variables()
    {

        // Get the values of the context variables.
        $variable_1 = $this->getContextValue('variable_1');
        $operator = $this->getContextValue('operator');
        $variable_2 = $this->getContextValue('variable_2');

        // Perform the desired actions based on the values of the context variables.
        // For example:
        if ($operator === '<' && $variable_1 < $variable_2) {
            return $variable_1 < $variable_2;
        } elseif ($operator === '>' && $variable_1 > $variable_2) {
            return $variable_1 > $variable_2;
        } elseif ($operator === '==' && $variable_1 === $variable_2) {
            return $variable_1 === $variable_2;
        } elseif ($operator === '!=' && $variable_1 !== $variable_2) {
            return $variable_1 !== $variable_2;
        }
    }

    /**
     * Adds a nested action to the container.
     */
    public function addSubaction(RulesActionInterface $action)
    {
        $this->subactions[] = $action;
    }

    /**
     * Executes nested actions.
     */
    protected function executeNestedActions()
    {
        // Execute each nested action.
        foreach ($this->subactions as $action) {
            // Check if the nested action is an IfActionContainer.
            if ($action instanceof IfActionContainer) {
                // Use the EdawahActionContainerForm to execute the nested actions.
                // $form_object = new EdawahActionContainerForm($action, \Drupal::formBuilder(), \Drupal::entityManager());
                $form_object = new IfActionContainerForm($this, \Drupal::formBuilder(), \Drupal::entityManager());
                $form_object->submitForm([], $form_object);

                echo json_encode('i see form object');
                echo json_encode($form_object);
            } else {
                // Use the EdawahActionForm to execute the nested actions.
                // $form_object = new EdawahActionForm($action, \Drupal::formBuilder(), \Drupal::entityManager());
                $form_object = new IfActionContainerForm($this, \Drupal::formBuilder(), \Drupal::entityManager());
                $form_object->submitForm([], $form_object);

                echo json_encode('i see form object');
                echo json_encode($form_object);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE)
    {

        if ($return_as_object) {
            return AccessResult::allowedIfHasPermission($account, 'access content');
        }

        return $account->hasPermission('access content');
    }
}
