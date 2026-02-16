<?php

namespace Drupal\tv_projects\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ProjectForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'tv_projects_project_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['project_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Project Name'),
      '#required' => TRUE,
    ];

    $form['project_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#default_value' => '',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Project'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (empty($form_state->getValue('project_name'))) {
      $form_state->setErrorByName('project_name', $this->t('You must specify the name of the project.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Create or load a node of type 'program'.
    $node = \Drupal\node\Entity\Node::create([
        'type' => 'project',
        'title' => 'Project for ' . $form_state->getValue('project_name'),
    ]);
    
    // Populate node fields with values from the form.
    $node->set('field_project_name', $form_state->getValue('project_name'));
    $node->set('field_project_description', $form_state->getValue('project_description'));
    
    // Save the node.
    try {
        $node->save();
        \Drupal::messenger()->addMessage($this->t('The project has been successfully saved.'));
    } catch (\Exception $e) {
        \Drupal::logger('tv_projects')->error('Failed to save the project: @message', ['@message' => $e->getMessage()]);
        \Drupal::messenger()->addError($this->t('There was a problem saving the project. Please contact the administrator.'));
    }

    // Redirect after saving.
    $form_state->setRedirect('entity.node.canonical', ['node' => $node->id()]);
  }

}
