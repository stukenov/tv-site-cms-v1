<?php

namespace Drupal\tv_schedule\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SettingsForm extends ConfigFormBase {
  protected function getEditableConfigNames() {
    return ['tv_schedule.settings'];
  }

  public function getFormId() {
    return 'tv_schedule_admin_settings';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('tv_schedule.settings');
    // Формат времени для одного элемента
    $form['time_format'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Time format'),
      '#default_value' => $config->get('time_format'),
    ];
    
    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('tv_schedule.settings')
      ->save();
    parent::submitForm($form, $form_state);
  }
}
