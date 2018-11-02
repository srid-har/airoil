<?php

namespace AppBundle\Entity;

use Orbitale\Bundle\CmsBundle\Entity\Page as BasePage;
use Doctrine\ORM\Mapping as ORM;
/**
 * Orbitale_cms_pages
 * @ORM\Entity
 * @ORM\Table
 */
class Page extends BasePage
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}