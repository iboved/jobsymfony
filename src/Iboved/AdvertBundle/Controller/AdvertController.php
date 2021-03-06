<?php

namespace Iboved\AdvertBundle\Controller;

use Iboved\AdvertBundle\Entity\Advert;
use Iboved\AdvertBundle\Form\Type\AddAdvertType;
use Iboved\AdvertBundle\Form\Type\EditAdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $adverts = $this->getDoctrine()
            ->getRepository('IbovedAdvertBundle:Advert')
            ->findBy([], ['id' => 'DESC']);

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

        if (!$advert) {
            throw $this->createNotFoundException(
                'No advert found for slug ' . $slug
            );
        }

        return array("advert" =>  $advert);
    }

    /**
     * @Template
     * @Route("/advert/{slug}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('IbovedAdvertBundle:Advert')->findOneBySlug($slug);

        if (!$advert) {
            throw $this->createNotFoundException(
                'No advert found for slug ' . $slug
            );
        }

        $form = $this->createForm(new EditAdvertType(), $advert);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('iboved.advert.phone_handler')
                ->editPhone($advert);

            $em->flush();

            return $this->redirect($this->generateUrl('iboved_advert_advert_index'));
        }

        return array(
            "form" =>  $form->createView(),
            "advert" =>  $advert,
        );
    }

    /**
     * @Template
     * @Route("/advert/{slug}/delete")
     * @Method({"DELETE"})
     */
    public function deleteAdvertAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('IbovedAdvertBundle:Advert')->findBySlug($slug)[0];

        $em->remove($advert);
        $em->flush();

        return JsonResponse::create(["code" => 200]);
    }
}
