<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/Category", name="Category")
     */
    public function indexAction(Request $request)
    {
         $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Categorylist A 
                        ORDER BY A.categorylist ASC'
                    );
            $category = $query->getResult();

        // $repository = $this->getDoctrine()->getRepository('AppBundle:Categorylist');
        // $category = $repository->findAll();

        $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Manufacturer A 
                        ORDER BY A.manufacturer_name ASC'
                    );
            $manufacturer = $query->getResult();

        // $repository = $this->getDoctrine()->getRepository('AppBundle:Manufacturer');
        // $manufacturer = $repository->findAll();
        // replace this example code with whatever you need
        return $this->render('categorylist/index.html.twig', array('category' => $category,'manufacturer' => $manufacturer,'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
}
