<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Banner;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // $repository = $this->getDoctrine()->getRepository('AppBundle:Pages');
        // $cms_pages = $repository->findAll();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Banner');
        $banner = $repository->findAll();

        // $repository = $this->getDoctrine()->getRepository('AppBundle:Banner');
        // $banner = $repository->findAll();
        
        // replace this example code with whatever you need
        // return $this->render('default/index.html.twig', array('Banner' => $banner,
        //     'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        // ));


        return $this->redirect('home');
    }
}
