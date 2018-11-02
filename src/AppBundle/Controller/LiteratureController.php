<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Searchliterature;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LiteratureController extends Controller
{
    /**
     * @Route("/Literature", name="Literature")
     */
    public function indexAction(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository('AppBundle:Manufacturer');
        $manufacturer = $repository->findAll();

        $search = new Searchliterature();       

        $name= "nothing";
        /// query open tag
        $em = $this->getDoctrine()->getManager();
        /// query open close

        if ($request->isMethod('POST'))
        {
            $form = $this->createFormBuilder($search)
                    ->add('Manufacturer', ChoiceType::class, array('choices'  => $this->buildChoices(),'attr' => array('class' => 'form-control')))
                    ->add('Product', ChoiceType::class, array('choices'  => $this->buildChoices3(),'attr' => array('class' => 'form-control')))
                    ->add('name',TextType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('description',TextareaType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('save', SubmitType::class, array('label' => 'Search','attr' => array('class' => 'btn btn-default')))
                    ->getForm();

            $form->submit($request);

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form['Manufacturer']->getData();
            $productname = $form['Product']->getData();
            $searchName = $form['name']->getData();
            // ... perform some action, such as saving the task to the database
            $name = $task;
            if($productname != 0 )
            {
                $name =$productname;
                if($searchName == "" )
                {
                    $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Literature A
                        WHERE A.type = :type AND A.manufacturer = :task AND A.product = :product
                        ORDER BY A.id ASC'
                    )->setParameter('type', 'literature')
                     ->setParameter('task', $task)
                     ->setParameter('product', $productname);
                }
                else
                {
                    $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Literature A
                        WHERE A.type = :type AND A.manufacturer = :task AND A.product = :product AND A.name like :name
                        ORDER BY A.id ASC'
                    )->setParameter('type', 'literature')
                     ->setParameter('task', $task)
                     ->setParameter('product', $productname)
                     ->setParameter('name', '%'.$searchName.'%');
                }

                $form = $this->createFormBuilder($search)
                    ->add('Manufacturer', ChoiceType::class, array('choices'  => $this->buildChoices(),'attr' => array('class' => 'form-control')))
                    ->add('Product', ChoiceType::class, array('choices'  => $this->buildChoices2($task),'attr' => array('class' => 'form-control')))
                    ->add('name',TextType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('description',TextareaType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('save', SubmitType::class, array('label' => 'Search','attr' => array('class' => 'btn btn-default')))
                    ->getForm();
            }
            else
            {
                $name ="manu - 1".$productname;

                $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Literature A
                        WHERE A.type = :type AND A.manufacturer = :task 
                        ORDER BY A.id ASC'
                    )->setParameter('type', 'literature')
                     ->setParameter('task', $task);
            }

                $form = $this->createFormBuilder($search)
                    ->add('Manufacturer', ChoiceType::class, array('choices'  => $this->buildChoices(),'attr' => array('class' => 'form-control')))
                    ->add('Product', ChoiceType::class, array('choices'  => $this->buildChoices2($task),'attr' => array('class' => 'form-control')))
                    ->add('name',TextType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('description',TextareaType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('save', SubmitType::class, array('label' => 'Search','attr' => array('class' => 'btn btn-default')))
                    ->getForm();
            
        }
        else
        {
            $form = $this->createFormBuilder($search)
                ->add('Manufacturer', ChoiceType::class, array('choices'  => $this->buildChoices(),'attr' => array('class' => 'form-control')))
                ->add('Product', ChoiceType::class, array('choices'  => $this->buildChoices1(),'attr' => array('class' => 'form-control')))
                ->add('name',TextType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                ->add('description',TextareaType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                ->add('save', SubmitType::class, array('label' => 'Search','attr' => array('class' => 'btn btn-default')))
                ->getForm();
            $task = 'yes';
            $name = $task;
            //////////////            
            $query = $em->createQuery(
                'SELECT A
                FROM AppBundle:Literature A
                WHERE A.type = :type
                ORDER BY A.id ASC'
            )->setParameter('type', 'literature');
            
        }

        $literature = $query->getResult();

        // replace this example code with whatever you need
        return $this->render('literature/index.html.twig', array('name' =>$name ,'form' => $form->createView(),'manufacturer' => $manufacturer,'literature' => $literature,'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
    /**
     * @Route("/Download", name="Download")
     */
    public function downloadAction(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository('AppBundle:Manufacturer');
        $manufacturer = $repository->findAll();

        $search = new Searchliterature();       

        $name= "nothing";
        /// query open tag
        $em = $this->getDoctrine()->getManager();
        /// query open close

        if ($request->isMethod('POST'))
        {
            $form = $this->createFormBuilder($search)
                    ->add('Manufacturer', ChoiceType::class, array('choices'  => $this->buildChoices(),'attr' => array('class' => 'form-control')))
                    ->add('Product', ChoiceType::class, array('choices'  => $this->buildChoices3(),'attr' => array('class' => 'form-control')))
                    ->add('name',TextType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('description',TextareaType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('save', SubmitType::class, array('label' => 'Search','attr' => array('class' => 'btn btn-default')))
                    ->getForm();

            $form->submit($request);

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form['Manufacturer']->getData();
            $productname = $form['Product']->getData();
            $searchName = $form['name']->getData();
            // ... perform some action, such as saving the task to the database
            $name = $task;
            if($productname != 0 )
            {
                $name =$productname;
                if($searchName == "" )
                {
                    $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Literature A
                        WHERE A.type != :type AND A.manufacturer = :task AND A.product = :product
                        ORDER BY A.id ASC'
                    )->setParameter('type', 'literature')
                     ->setParameter('task', $task)
                     ->setParameter('product', $productname);
                }
                else
                {
                    $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Literature A
                        WHERE A.type != :type AND A.manufacturer = :task AND A.product = :product AND A.name like :name
                        ORDER BY A.id ASC'
                    )->setParameter('type', 'literature')
                     ->setParameter('task', $task)
                     ->setParameter('product', $productname)
                     ->setParameter('name', '%'.$searchName.'%');
                }

                $form = $this->createFormBuilder($search)
                    ->add('Manufacturer', ChoiceType::class, array('choices'  => $this->buildChoices(),'attr' => array('class' => 'form-control')))
                    ->add('Product', ChoiceType::class, array('choices'  => $this->buildChoices2($task),'attr' => array('class' => 'form-control')))
                    ->add('name',TextType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('description',TextareaType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('save', SubmitType::class, array('label' => 'Search','attr' => array('class' => 'btn btn-default')))
                    ->getForm();
            }
            else
            {
                $name ="manu - 1".$productname;

                $query = $em->createQuery(
                        'SELECT A
                        FROM AppBundle:Literature A
                        WHERE A.type != :type AND A.manufacturer = :task 
                        ORDER BY A.id ASC'
                    )->setParameter('type', 'literature')
                     ->setParameter('task', $task);
            }

                $form = $this->createFormBuilder($search)
                    ->add('Manufacturer', ChoiceType::class, array('choices'  => $this->buildChoices(),'attr' => array('class' => 'form-control')))
                    ->add('Product', ChoiceType::class, array('choices'  => $this->buildChoices2($task),'attr' => array('class' => 'form-control')))
                    ->add('name',TextType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('description',TextareaType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                    ->add('save', SubmitType::class, array('label' => 'Search','attr' => array('class' => 'btn btn-default')))
                    ->getForm();
            
        }
        else
        {
            $form = $this->createFormBuilder($search)
                ->add('Manufacturer', ChoiceType::class, array('choices'  => $this->buildChoices(),'attr' => array('class' => 'form-control')))
                ->add('Product', ChoiceType::class, array('choices'  => $this->buildChoices1(),'attr' => array('class' => 'form-control')))
                ->add('name',TextType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                ->add('description',TextareaType::class,array('required' => false,'attr' => array('class' => 'form-control')))
                ->add('save', SubmitType::class, array('label' => 'Search','attr' => array('class' => 'btn btn-default')))
                ->getForm();
            $task = 'yes';
            $name = $task;
            //////////////            
            $query = $em->createQuery(
                'SELECT A
                FROM AppBundle:Literature A
                WHERE A.type != :type
                ORDER BY A.id ASC,A.name ASC'
            )->setParameter('type', 'literature');
            
        }

        $literature = $query->getResult();

        // replace this example code with whatever you need
        return $this->render('literature/download.html.twig', array('name' =>$name ,'form' => $form->createView(),'manufacturer' => $manufacturer,'literature' => $literature,'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
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
    protected function buildChoices1() {
        $choices          = [];
        $table2Repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $table2Objects    = $table2Repository->findAll();
        $choices['0'] = "select";
        // foreach ($table2Objects as $table2Obj) {
        //     $choices[$table2Obj->getId()] = $table2Obj->getName();
        // }

        return $choices;
    }
    protected function buildChoices3() {
        $choices          = [];
        $table2Repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $table2Objects    = $table2Repository->findAll();
        $choices['0'] = "select";
        foreach ($table2Objects as $table2Obj) {
            $choices[$table2Obj->getId()] = $table2Obj->getName();
        }

        return $choices;
    }
    protected function buildChoices2($idpro) {
        $choices          = [];
        $table2Repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $table2Objects    = $table2Repository->findBy(['manufacturer' => $idpro]);
        $choices['0'] = "select";
        foreach ($table2Objects as $table2Obj) {
            $choices[$table2Obj->getId()] = $table2Obj->getName();
        }

        return $choices;
    }
}
