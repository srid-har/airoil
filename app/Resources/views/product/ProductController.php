<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Search;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductController extends Controller
{
    /**
     * @Route("/Product", name="Product")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Categorylist');
        $category = $repository->findAll();

        // $repository = $this->getDoctrine()->getRepository('AppBundle:Manufacturer');
        // $manufacturer = $repository->findAll();

        $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Manufacturer A 
                        ORDER BY A.manufacturer_name ASC'
                    );
            $manufacturer = $query->getResult();

        // replace this example code with whatever you need
        return $this->render('product/index.html.twig', array('category' => $category,'manufacturer' => $manufacturer,'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
    /**
     * @Route("/Manufacturer/home", name="Manufacturerhome")
     * 
     */
    public function index1Action(Request $request)
    {
        return $this->redirect('../home');
    }
    /**
     * @Route("/Product/home", name="Producthome")
     * 
     */
    public function index11Action(Request $request)
    {
        return $this->redirect('../home');
    }
     /**
     * @Route("/Manufacturer/{productid}", name="ProductName")
     */
    public function manufacturerAction(Request $request)
    {
        // $productid = $request->query->get('productid'); // get a $_GET parameter
        $id = $request->get('productid'); 

        $repository = $this->getDoctrine()->getRepository('AppBundle:Categorylist');
        $category = $repository->findAll();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Manufacturer');
        $manufacturer = $repository->find($id);

        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $product = $repository->findBy(['manufacturer' => $id]);

        $repository = $this->getDoctrine()->getRepository('AppBundle:Literature');
        $literature = $repository->findBy(['manufacturer' => $id]);

        return $this->render('product/manufacturer.html.twig', array('pr_id'=>$id,'product'=>$product,'literature'=>$literature,'category' => $category,'manufacturer' => $manufacturer,'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
     /**
     * @Route("/Product/{productid}", name="ProductsName")
     */
    public function productAction(Request $request)
    {
        // $productid = $request->query->get('productid'); // get a $_GET parameter
        $id = $request->get('productid'); 

        $repository = $this->getDoctrine()->getRepository('AppBundle:Categorylist');
        $category = $repository->findAll();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Manufacturer');
        $manufacturer = $repository->findAll();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $product = $repository->find($id);

        $repository = $this->getDoctrine()->getRepository('AppBundle:Literature');
        $literature = $repository->findBy(['manufacturer' => $id]);

        return $this->render('product/product.html.twig', array('pr_id'=>$id,'product'=>$product,'literature'=>$literature,'category' => $category,'manufacturer' => $manufacturer,'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
    /**
     * @Route("/Product_search", name="ProductSearch")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Manufacturer');
        $manufacturer = $repository->findAll();

        $search = new Search();
        // $search->setSearch('Write a blog post');
        $form = $this->createFormBuilder($search)
            ->add('Manufacturer', ChoiceType::class, array('choices'  => $this->buildChoices()))
            ->add('name',TextType::class,array('required' => false))
            ->add('save', SubmitType::class, array('label' => 'Search'))
            ->getForm();

        $name= "nothing";

       if ($request->isMethod('POST')) {
            $form->submit($request);

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form['Manufacturer']->getData();
            $searchName = $form['name']->getData();
            $name = $task;
            // return $this->redirectToRoute("sdfgsdfsd");
            $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
             // $product = $repository->findAll();
            if($searchName == "")
            {
                 $product = $repository->findBy(['manufacturer' => $task]);
            }
            else
            {
                $product = $repository->findBy(['manufacturer' => $task,'name'=>'%'.$searchName.'%']);
            }         
        }
        else
        {
            // $task = $form->getData('search');
            $task = 'yes';
            $name = $task;
            //  $repository = $this->getDoctrine()->getRepository('AppBundle:Product');

            // $product = $repository->findAll();
            
            $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Product A 
                        ORDER BY A.name ASC'
                    );
            $product = $query->getResult();
        }
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Categorylist');

        $category = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('product/search.html.twig', array('form' => $form->createView(),'product' => $product,'manufacturer' => $manufacturer,'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
    protected function buildChoices() {
            $choices          = [];
            $table2Repository = $this->getDoctrine()->getRepository('AppBundle:Manufacturer');
            $table2Objects    = $table2Repository->findAll();

            foreach ($table2Objects as $table2Obj) {
                $choices[$table2Obj->getId()] = $table2Obj->getManufacturerName();
            }

            return $choices;
    }
    /**
     * @Route("/Product/home/val-u-added-services", name="Producthome1")
     */
    public function index12Action(Request $request)
    {
        return $this->redirect('../../home/val-u-added-services');
    }
    /**
     * @Route("/Product/home/about", name="Producthome2")
     */
    public function index13Action(Request $request)
    {
        return $this->redirect('../../home/about');
    }
    /**
     * @Route("/Product/home/employment", name="Producthome3")
     */
    public function index14Action(Request $request)
    {
        return $this->redirect('../../home/employment');
    }
    /**
     * @Route("/Product/home/new", name="Producthome4")
     */
    public function index15Action(Request $request)
    {
        return $this->redirect('../../home/new');
    }
    /**
     * @Route("/Product/home/newsletter", name="Producthome5")
     */
    public function index16Action(Request $request)
    {
        return $this->redirect('../../home/newsletter');
    }
    /**
     * @Route("/Product/home/credit", name="Producthome6")
     */
    public function index17Action(Request $request)
    {
        return $this->redirect('../../home/credit');
    }
    /**
     * @Route("/Product/home/cv", name="Producthome7")
     */
    public function index18Action(Request $request)
    {
        return $this->redirect('../../home/cv');
    }

    /**
     * @Route("/Product/home/links", name="Producthome8")
     */
    public function index19Action(Request $request)
    {
        return $this->redirect('../../home/links');
    }

    /**
     * @Route("/Product/home/contact", name="Producthome9")
     */
    public function index20Action(Request $request)
    {
        return $this->redirect('../../home/contact');
    }

    /**
     * @Route("/Manufacturer/home/val-u-added-services", name="Manufacturerhome1")
     */
    public function index2Action(Request $request)
    {
        return $this->redirect('../../home/val-u-added-services');
    }
    /**
     * @Route("/Manufacturer/home/about", name="Manufacturerhome2")
     */
    public function index3Action(Request $request)
    {
        return $this->redirect('../../home/about');
    }
    /**
     * @Route("/Manufacturer/home/employment", name="Manufacturerhome3")
     */
    public function index4Action(Request $request)
    {
        return $this->redirect('../../home/employment');
    }
    /**
     * @Route("/Manufacturer/home/new", name="Manufacturerhome4")
     */
    public function index5Action(Request $request)
    {
        return $this->redirect('../../home/new');
    }
    /**
     * @Route("/Manufacturer/home/newsletter", name="Manufacturerhome5")
     */
    public function index6Action(Request $request)
    {
        return $this->redirect('../../home/newsletter');
    }
    /**
     * @Route("/Manufacturer/home/credit", name="Manufacturerhome6")
     */
    public function index7Action(Request $request)
    {
        return $this->redirect('../../home/credit');
    }
    /**
     * @Route("/Manufacturer/home/cv", name="Manufacturerhome7")
     */
    public function index8Action(Request $request)
    {
        return $this->redirect('../../home/cv');
    }

    /**
     * @Route("/Manufacturer/home/links", name="Manufacturerhome8")
     */
    public function index9Action(Request $request)
    {
        return $this->redirect('../../home/links');
    }

    /**
     * @Route("/Manufacturer/home/contact", name="Manufacturerhome9")
     */
    public function index10Action(Request $request)
    {
        return $this->redirect('../../home/contact');
    }
}
