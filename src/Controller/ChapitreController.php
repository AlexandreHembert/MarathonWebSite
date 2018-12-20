<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 19/12/2018
 * Time: 20:07
 */

namespace App\Controller;
use App\Entity\Chapitre;
use App\Entity\Histoire;
use App\Form\ChapitreType;
use App\Security\AppAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chapitre")
 */
class ChapitreController extends AbstractController
{
    /**
     * @Route("/", name="chapitre_index", methods="GET")
     */
    public function index(): Response
    {
        $chapitres = $this->getDoctrine()
            ->getRepository(Chapitre::class)
            ->findAll();
        return $this->render('chapitre/index.html.twig', ['chapitres' => $chapitres]);
    }
    /**
     * @Route("/new", name="chapitre_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $chapitre = new Chapitre();
        $form = $this->createForm(ChapitreType::class, $chapitre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chapitre);
            $em->flush();
            return $this->redirectToRoute('chapitre_index');
        }
        return $this->render('chapitre/new.html.twig', [
            'chapitre' => $chapitre,
            'formCreerChapitre' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="chapitre_show", methods="GET")
     */
    public function show(Chapitre $chapitre): Response
    {
        return $this->render('histoire/show.html.twig', ['chapitre' => $chapitre]);
    }

    /**
     * @Route("/{id}/edit", name="chapitre_show", methods="GET|POST")
     */
    public function edit(Request $request, Chapitre $chapitre): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::CHAPITRE_EDIT, $chapitre);
        $form = $this->createForm(ChapitreType::class, $chapitre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('chapitre_index', ['id' => $chapitre->getId()]);
        }
        return $this->render('chapitre/edit.html.twig', [
            'chapitre' => $chapitre,
            'formModifChapitre' => $form->createView(),
        ]);
    }

}