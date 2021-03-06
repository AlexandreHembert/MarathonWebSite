<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 19/12/2018
 * Time: 20:07
 */

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Chapitre;
use App\Entity\Histoire;
use App\Form\HistoireType;
use App\Security\AppAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Upload\FileHistoireTypeUpload;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/histoire")
 */
class HistoireController extends AbstractController
{
    /**
     * @Route("/", name="histoire_index", methods="GET")
     */
    public function index(): Response
    {
        $histoires = $this->getDoctrine()
            ->getRepository(Histoire::class)
            ->findAll();
        return $this->render('visualisation', [
            'histoires' => $histoires,
        ]);
    }

    /**
     * @Route("/new", name="histoire_new", methods="GET|POST")
     */
    public function new(Request $request, FileHistoireTypeUpload $fileHistoireTypeUpload): Response
    {
        $histoire = new Histoire();
        $form = $this->createForm(HistoireType::class, $histoire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fileHistoireTypeUpload->upload($histoire);
            $em = $this->getDoctrine()->getManager();
            $em->persist($histoire);
            $em->flush();
            return $this->redirectToRoute('visualisation');
        }
        return $this->render('histoire/new.html.twig', [
            'histoire' => $histoire,
            'formCreerHistoire' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="histoire_show", methods="GET")
     */
    public function show(Histoire $histoire): Response
    {
        $parent = $em = $this->getDoctrine()->getManager()->getRepository(Chapitre::class)
            ->findOneBy(['histoire' => $histoire, 'premier' => true]);
        $chapitres = $em = $this->getDoctrine()->getManager()->getRepository(Chapitre::class)
            ->findBy(['histoire' => $histoire, 'premier' => false]);
        $avisG = $em = $this->getDoctrine()->getManager()->getRepository(Avis::class)
            ->findBy(['histoires' => $histoire, 'positif' => true]);
        $avisB = $em = $this->getDoctrine()->getManager()->getRepository(Avis::class)
            ->findBy(['histoires' => $histoire, 'positif' => false]);

        return $this->render('histoire/show.html.twig',
            ['histoire' => $histoire, 'parent' => $parent, 'chapitres' => $chapitres, 'avisG' => $avisG, 'avisB' => $avisB]);

    }

    /**
     * @Route("/{id}/edit", name="histoire_edit", methods="GET|POST")
     */
    public function edit(Request $request, Histoire $histoire, FileHistoireTypeUpload $fileHistoireTypeUpload): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::HISTOIRE_EDIT, $histoire);
        $form = $this->createForm(HistoireType::class, $histoire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fileHistoireTypeUpload->upload($histoire);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('histoire_index', ['id' => $histoire->getId()]);
        }
        return $this->render('histoire/edit.html.twig', [
            'histoire' => $histoire,
            'formModifHistoire' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="histoire_delete", methods="DELETE")
     */
    public function delete(Request $request, Histoire $histoire): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::HISTOIRE_DELETE, $histoire);
        if ($this->isCsrfTokenValid('delete' . $histoire->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(Chapitre::class);
            $chapitres = $repository->findBy(['histoire' => $histoire]);

            foreach ($chapitres as $chapitre) {

                $em->remove($chapitre);
            }
            $em->remove($histoire);
            $em->flush();
        }
        return $this->redirectToRoute('visualisation');
    }
}