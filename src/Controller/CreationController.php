<?php

namespace App\Controller;

use App\Entity\Chapitre;
use App\Entity\Histoire;
use App\Entity\Suite;
use App\Form\ChapitreType;
use App\Form\HistoireType;
use App\Form\SuiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreationController extends AbstractController {
    /**
     * @Route("/creation/histoire", name="creer_histoire")
     */
    public function creerHistoire(Request $request) {
        //TODO
        $histoire = new Histoire();
        $form = $this->createForm(HistoireType::class, $histoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($histoire);
            $em->flush();

            return $this->redirectToRoute('visualisation');
        }

        return $this->render('creation/creation_histoire.html.twig', [
            'histoire' => $histoire,
            'formCreerHistoire' => $form->createView(),
        ]);
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
    public function lierChapitre(Request $request) {
        //TODO
        $suite = new Suite();

        $repository = $this->getDoctrine()->getRepository(Histoire::class);
        $histoire = $repository->findBy(['user' => $this->getUser()]);

        $repository = $this->getDoctrine()->getRepository(Chapitre::class);
        $chapitres = $repository->findBy(['histoire' => $histoire]);


        $form = $this->createForm(SuiteType::class, $suite);
        $form->handleRequest($request);




        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($suite);
            $em->flush();

            return $this->redirectToRoute('visualisation');
        }

        return $this->render('creation/lier_chapitre.html.twig', [
            'suite' => $suite,
            'formCreerSuite' => $form->createView()
        ]);
    }

}
