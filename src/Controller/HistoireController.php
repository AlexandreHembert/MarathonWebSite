<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 19/12/2018
 * Time: 20:07
 */

namespace App\Controller;

use App\Entity\Histoire;
use App\Form\HistoireType;
use App\Security\AppAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('histoire/index.html.twig', ['histoires' => $histoires]);
    }
    /**
     * @Route("/new", name="histoire_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $histoire = new Histoire();
        $form = $this->createForm(HistoireType::class, $histoire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($histoire);
            $em->flush();
            return $this->redirectToRoute('histoire_index');
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
        return $this->render('histoire/show.html.twig', ['histoire' => $histoire]);
    }

    /**
     * @Route("/{id}/edit", name="histoire_edit", methods="GET|POST")
     */
    public function edit(Request $request, Histoire $histoire): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::HISTOIRE_EDIT, $histoire);
        $form = $this->createForm(HistoireType::class, $histoire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('histoire_index', ['id' => $histoire->getId()]);
        }
        return $this->render('histoire/edit.html.twig', [
            'histoire' => $histoire,
            'formModifHistoire' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="histoire_delete", methods="DELETE")
     */
    public function delete(Request $request, Histoire $histoire): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::HISTOIRE_DELETE, $histoire);
        if ($this->isCsrfTokenValid('delete'.$histoire->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($histoire);
            $em->flush();
        }
        return $this->redirectToRoute('histoire_index');
    }
}