<?php

namespace Iboved\AdvertBundle\Controller;

use Iboved\AdvertBundle\Entity\Advert;
use Iboved\AdvertBundle\Form\Type\AddAdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('IbovedAdvertBundle:Advert')->findBy([], ['id' => 'DESC']);

        return array("adverts" =>  $adverts);
    }

    /**
     * @Template
     * @Route("/advert/add")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $advert = new Advert();

        $form = $this->createForm(new AddAdvertType(), $advert);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('iboved.advert.phone_handler')
                ->editPhone($advert);

            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirect($this->generateUrl('iboved_advert_advert_index'));
        }

        return array("form" =>  $form->createView());
    }

    /**
     * @Template
     * @Route("/advert/{slug}")
     * @Method({"GET"})
     */
    public function viewAction($slug)
    {
        $advert = $this->getDoctrine()
            ->getRepository('IbovedAdvertBundle:Advert')
            ->findOneBySlug($slug);

        return array("advert" =>  $advert);
    }
}
