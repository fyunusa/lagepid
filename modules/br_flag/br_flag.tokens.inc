<?php

/**
 * @file
 * File for br_flag token hooks.
 */

use Drupal\Core\Render\BubbleableMetadata;
use Drupal\user\UserInterface;
use Drupal\node\NodeInterface;
use Drupal\comment\CommentInterface;

/**
 * Implements hook_token_info().
 */
function br_flag_token_info() {
  $flagging['entity_user'] = [
    'name' => t('Flagging entity User'),
    'description' => t('@type field.', ['@type' => 'Entity reference to User']),
    'type' => 'user',
  ];

  $flagging['entity_node'] = [
    'name' => t('Flagging entity Node'),
    'description' => t('@type field.', ['@type' => 'Entity reference to Node']),
    'type' => 'node',
  ];

  $flagging['entity_comment'] = [
    'name' => t('Flagging entity Comment'),
    'description' => t('@type field.', ['@type' => 'Entity reference to Comment']),
    'type' => 'comment',
  ];

  return [
    'tokens' => ['flagging' => $flagging],
  ];
}


/**
 * Implements hook_tokens().
 */
function br_flag_tokens($type, $tokens, array $data, array $options, BubbleableMetadata $bubbleable_metadata) {
  $token_service = \Drupal::token();
  $replacements = [];


  if ($type == 'flagging' && !empty($data['flagging'])) {
    $data_flagging = $data['flagging'];
    $flaggable_type = $data_flagging->getFlaggableType();
    $flaggable_id = $data_flagging->getFlaggableId();
    $entity_storage = \Drupal::entityManager()->getStorage($flaggable_type)->load($flaggable_id);

    foreach ($tokens as $name => $original) {
      switch ($name) {
        case 'entity_user':
        case 'entity_node':
        case 'entity_comment':
          $replacements[$original] = $entity_storage->label();
          $bubbleable_metadata->addCacheableDependency($entity_storage);
          break;
      }
    }

    $token_name = strtok($name, ':');
    if ($entity_tokens = $token_service->findWithPrefix($tokens, $token_name)) {
      $replacements += $token_service
        ->generate(
          $flaggable_type,
          $entity_tokens,
          [$flaggable_type => $entity_storage],
          $options,
          $bubbleable_metadata);
    }
  }

  return $replacements;
}
