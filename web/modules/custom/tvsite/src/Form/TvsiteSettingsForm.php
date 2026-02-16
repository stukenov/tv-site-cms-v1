<?php

namespace Drupal\tvsite\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures TVsite settings.
 */
class TvsiteSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'tvsite_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'tvsite.settings',
    ];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('tvsite.settings');

    $form['channel_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Channel Name'),
      '#default_value' => $config->get('channel_name'),
    ];

    return parent::buildForm($form, $form_state);
  }

}

