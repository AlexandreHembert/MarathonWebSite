<?php

namespace App\Controller;

use App\Entity\Chapitre;
use App\Form\ChapitreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreationController extends AbstractController {
    /**
     * @Route("/creation", name="creation")
     */
    public function index() {
        return $this->render('creation/index.html.twig', [
            'controller_name' => 'CreationController',
        ]);
    }


    //---------------------------------------------------------

    /**
     * @Route("/creation/histoire", name="creer_histoire")
     */
    public function creerHistoire() {
        return $this->render('creation/creation_histoire.html.twig', [
            'controller_name' => 'CreationController',
        ]);
    }

    public function enregistrerHistoire() {
        // TODO
    }


    //---------------------------------------------------------

    /**
     * @Route("/creation/chapitre", name="creer_chapitre")
     */
    public function creerChapitre(Request $request) {
        // TODO
        $chapitre = new Chapitre();
        $form = $this->createForm(ChapitreType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chapitre);
            $em->flush();

            return $this->redirectToRoute('visualisation');
        }

        return $this->render('creation/creation_chapitre.html.twig', [
            'chapitre' => $chapitre,
            'formCreerChapitre' => $form->createView(),
        ]);

    }


    //---------------------------------------------------------

    /**
     * @Route("/creation/suite", name="lier_chapitre")
     */
    public function lierChapitre() {
        return $this->render('creation/lier_chapitre.html.twig', [
            'controller_name' => 'CreationController',
        ]);
    }

    public function enregistrerLiaison() {
        // TODO
    }


}
