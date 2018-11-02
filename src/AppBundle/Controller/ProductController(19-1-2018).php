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
        $repository = $this->getDoctrine()->getRepository('AppBundle:Categorylist');
        $category = $repository->findAll();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Manufacturer');
        $manufacturer = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('product/index.html.twig', array('category' => $category,'manufacturer' => $manufacturer,'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
     /**
     * @Route("/Product/product/{productid}", name="ProductName")
     */
    public function productAction(Request $request)
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

        return $this->render('product/product.html.twig', array('pr_id'=>$id,'product'=>$product,'literature'=>$literature,'category' => $category,'manufacturer' => $manufacturer,'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
    /**
     * @Route("/Product/search", name="ProductSearch")
     */
    public function searchAction(Request $request)
    {
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
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();
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
            
            // $em = $this->getDoctrine()->getEntityManager();
            // $qb = $em->createQueryBuilder();

            //     $product = $qb->select('*')
            //               ->from('AppBundle:Product','*')
            //               ->where('manufacturer', $task)
            //               ->getQuery()
            //               ->getResult();

        }
        else
        {
            // $task = $form->getData('search');
            $task = 'yes';
            $name = $task;
             $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
            $product = $repository->findAll();
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
                $choices[$table2Obj->getId()] = $table2Obj->getManufacturerName() . ' - ' . $table2Obj->getManufacturerName();
            }

            return $choices;
    }
    /**
     * @Route("/Product/home", name="Producthome")
     */
    public function index1Action(Request $request)
    {
        return $this->redirect('../home');
    }
    public function index2Action(Request $request)
    {
        return $this->redirect('../../home/val-u-added-services');
    }
    /**
     * @Route("/Product/home/about", name="Producthome2")
     */
    public function index3Action(Request $request)
    {
        return $this->redirect('../../home/about');
    }
    /**
     * @Route("/Product/home/employment", name="Producthome3")
     */
    public function index4Action(Request $request)
    {
        return $this->redirect('../../home/employment');
    }
    /**
     * @Route("/Product/home/new", name="Producthome4")
     */
    public function index5Action(Request $request)
    {
        return $this->redirect('../../home/new');
    }
    /**
     * @Route("/Product/home/newsletter", name="Producthome5")
     */
    public function index6Action(Request $request)
    {
        return $this->redirect('../../home/newsletter');
    }
    /**
     * @Route("/Product/home/credit", name="Producthome6")
     */
    public function index7Action(Request $request)
    {
        return $this->redirect('../../home/credit');
    }
    /**
     * @Route("/Product/home/cv", name="Producthome7")
     */
    public function index8Action(Request $request)
    {
        return $this->redirect('../../home/cv');
    }

    /**
     * @Route("/Product/home/links", name="Producthome8")
     */
    public function index9Action(Request $request)
    {
        return $this->redirect('../../home/links');
    }

    /**
     * @Route("/Product/home/contact", name="Producthome9")
     */
    public function index10Action(Request $request)
    {
        return $this->redirect('../../home/contact');
    }

}
