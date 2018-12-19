<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 19/12/2018
 * Time: 11:13
 */

namespace App\Controller;


use App\Entity\Chapitre;
use App\Entity\Histoire;
use App\Form\ChapitreType;
use App\Form\HistoireType;
use App\Security\AppAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ModifController extends AbstractController{
    /**
     * @Route("/modif/histoire/{id}", name="histoire_edit", methods="GET|POST")
     */
    public function editHistoire(Request $request, Histoire $histoire): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::HISTOIRE_EDIT, $histoire);
        $form = $this->createForm(HistoireType::class, $histoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visualisation', ['id' => $histoire->getId()]);
        }

        return $this->render('modification/modif_histoire.html.twig', [
            'histoire' => $histoire,
            'formModifHistoire' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modif/chapitre/{id}", name="chapitre_edit", methods="GET|POST")
     */
    public function editChapitre(Request $request, Chapitre $chapitre): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::CHAPITRE_EDIT, $chapitre);
        $form = $this->createForm(ChapitreType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visualisation', ['id' => $chapitre->getId()]);
        }

        return $this->render('modification/modif_chapitre.html.twig', [
            'histoire' => $chapitre,
            'formModifChapitre' => $form->createView(),
        ]);
    }


}