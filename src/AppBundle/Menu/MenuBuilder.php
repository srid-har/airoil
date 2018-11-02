<?php
namespace AppBundle\Menu;
// namespace AppBundle\Controller;
// @ORM\Entity(repositoryClass="testBundle\Entity\repository")
// @ORM\Entity(repositoryClass="testBundle\Entity\repository");
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Orbitale\Bundle\CmsBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        
        
        // $repository = $this->getDoctrine()->getRepository('AppBundle:Page');
        // $menus = $repository->findAll();


        $menu->addChild('Home', array('route' => 'homepage'));

        // $repository = $this->getDoctrine()->getRepository('AppBundle:Pages');
        // $cms_pages = $repository->findAll();

        // $em = $this->container->get('doctrine.orm.entity_manager');
        // access services from the container!
        // $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        // $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

        $menu->addChild('Home1', array('route' => 'homepage'));

        // ... add more children

        return $menu;
    }

    
}