<?php
/**
 * @file
 * Contains Api Key Controller.
 */
namespace Drupal\addwebmodule\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\system\Form\SiteInformationForm;

class AddwebmoduleController{
    /**
     * @param $site_api_key - the API key parameter
     * @param NodeInterface $node - the node built from the node id parameter
     * @return JsonResponse
     */
    public function content($site_api_key, NodeInterface $node){
        // Site API Key configuration value
        $site_api_key = \Drupal::config('system.site')->get('siteapikey');

        // Make sure the supplied node is a page, the configuration key is set and matches the supplied key
        if($node->getType() == 'page' && $site_api_key != 'No API Key yet' && $site_api_key == $site_api_key){

            // Respond with the json representation of the node
            return new JsonResponse($node->toArray(), 200, ['Content-Type'=> 'application/json']);
        }

        // Respond with access denied
        return new JsonResponse(array("error" => "access denied"), 401, ['Content-Type'=> 'application/json']);
    }
}