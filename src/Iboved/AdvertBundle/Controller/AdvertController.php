<?php

namespace Iboved\AdvertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AdvertController extends Controller
{
    /**
     * @Template
     * @Route("/")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return array("hello" => "Hello, World!");
    }
}
