<?php
// src/AppBundle/Controller/ContentController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * A custom controller to handle a content specified by a route.
 */
class ContentController extends Controller
{
    /**
     * @param object $contentDocument the name of this parameter is defined
     *      by the RoutingBundle. You can also expect any route parameters
     *      or $template if you configured templates_by_class (see below).
     *
     * @return Response
     */
    public function demoAction($contentDocument)
    {
        // ... do things with $contentDocument and gather other information
        $customValue = 42;

        return $this->render('content/demo.html.twig', [
            'cmfMainContent' => $contentDocument,
            'custom_parameter' => $customValue,
        ]);
    }
}