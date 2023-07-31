<?php

// namespace Drupal\edawah_rules\Plugin\RulesAction;

// use Drupal\Component\Plugin\Derivative\DeriverBase;
// use Drupal\Core\Entity\EntityStorageInterface;
// use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
// use Drupal\rules\Engine\ExpressionManagerInterface;
// use Symfony\Component\DependencyInjection\ContainerInterface;

// /**
//  * Derives nested action plugin definitions for the 'IF' action container.
//  */
// class IfActionContainerDeriver extends DeriverBase implements ContainerDeriverInterface
// {
//     /**
//      * The config entity storage that holds Rules actions.
//      *
//      * @var \Drupal\Core\Entity\EntityStorageInterface
//      */
//     protected $storage;

//     /**
//      * Creates a new IfActionContainerDeriver object.
//      *
//      * @param \Drupal\Core\Entity\EntityStorageInterface $storage
//      *   The entity storage.
//      */
//     public function __construct(EntityStorageInterface $storage)
//     {
//         $this->storage = $storage;
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public static function create(ContainerInterface $container, $base_plugin_id)
//     {
//         return new static(
//             $container->get('entity_type.manager')->getStorage('rules_action')
//         );
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function getDerivativeDefinitions($base_plugin_definition)
//     {
//         // Load all available actions that can be nested under the 'IF' container.
//         $nested_actions = $this->storage->loadMultiple();

//         // Define the default action plugin IDs you want to include.
//         $default_action_ids = [
//             'rules_send_email_action',
//             'rules_create_entity_action',
//             // Add other default action IDs here if needed.
//         ];

//         $derivatives = [];
//         foreach ($nested_actions as $action_id => $action) {
//             // Check if the action is a default action that we want to include.
//             if (in_array($action_id, $default_action_ids)) {
//                 // Define the derivative ID using the action plugin ID.
//                 $derivative_id = "rules_if_container:$action_id";

//                 // Build the derivative plugin definition using the action's context definitions.
//                 $derivatives[$derivative_id] = [
//                     'context' => $action->getContextDefinitions(),
//                     'category' => 'EDAWAH RULES', // Set the category as desired for nested actions.
//                 ] + $base_plugin_definition;
//             }
//         }

//         return $derivatives;
//     }
// }
