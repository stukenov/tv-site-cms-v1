<?php

namespace Drupal\tv_projects\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\node\Entity\Node;

class ProjectsController extends ControllerBase {
  public function show() {
    $projectsData = $this->getProjectsData();
    if (empty($projectsData)) {
      $content = [
        '#theme' => 'tv_projects_display',
        '#items' => [],
        '#empty' => 'No projects available.',
        '#attached' => [
          'library' => [
            'tv_projects/tv_projects_styles',
          ],
        ],
        '#cache' => [
          'max-age' => 0, // Disable caching for this page.
        ],
      ];
    } else {
      $content = [
        '#theme' => 'tv_projects_display',
        '#items' => $projectsData,
        '#attached' => [
          'library' => [
            'tv_projects/tv_projects_styles',
          ],
        ],
        '#cache' => [
          'max-age' => 0, // Disable caching for this page.
        ],
      ];
    }

    return $content;
  }

  private function getProjectsData() {
    // Retrieve nodes of type 'project'.
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'project')
      ->sort('field_project_time', 'ASC')
      ->accessCheck(FALSE); // Ignore access checks for this query.
    
    $nids = $query->execute();
    $nodes = Node::loadMultiple($nids);

    $projects_data = [];
    foreach ($nodes as $node) {
      // Check for the existence of fields before using them.
      $name = $node->hasField('field_project_name') ? $node->get('field_project_name')->value : 'No name set';
      $description = $node->hasField('field_project_description') ? $node->get('field_project_description')->value : 'No description';

      // Build URL for each program.
      $url = Url::fromRoute('entity.node.canonical', ['node' => $node->id()], ['absolute' => TRUE]);
      $link = Link::fromTextAndUrl($node->getTitle(), $url)->toString();

      $projects_data[] = [
        'name' => $name,
        'project' => $link,
        'description' => $description,
      ];
    }

    return $projects_data;
  }
}
