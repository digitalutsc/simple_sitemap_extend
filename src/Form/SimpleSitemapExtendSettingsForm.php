<?php

namespace Drupal\simple_sitemap_extend\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for the module.
 *
 * @package Drupal\simple_sitemap_extend\Form
 */
class SimpleSitemapExtendSettingsForm extends FormBase {

  const SIMPLE_SITEMAP_EXTEND_SETTINGS_PAGE = 'simple_sitemap_extend_settings_page:values';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'simple_sitemap_extend_settings_page';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $values = \Drupal::state()->get(self::SIMPLE_SITEMAP_EXTEND_SETTINGS_PAGE);
    $form = [];

    $form['exclude_field'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Field"),
      '#description' => $this->t("The field to check for exclusion"),
      '#required' => FALSE,
      '#default_value' => $values['exclude_field'],

    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $submitted_values = $form_state->cleanValues()->getValues();

    \Drupal::state()->set(self::SIMPLE_SITEMAP_EXTEND_SETTINGS_PAGE, $submitted_values);
    $messenger = \Drupal::service('messenger');
    $messenger->addMessage($this->t("Configuration Saved"));
  }

}
