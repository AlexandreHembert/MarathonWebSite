<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 19/12/2018
 * Time: 17:03
 */


namespace App\Controller;

use App\Entity\Chapitre;
use App\Entity\Suite;
use App\Form\SuiteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SuiteController extends AbstractController
{
    /**
     * @Route("/suite/new/{idSource}/{idDest}", name="suite_new", methods="GET|POST"))
     *
     */
    public function new(Request $request, Chapitre $src, Chapitre $dest)
    {
        $suite = new Suite();
        $form = $this->createForm(SuiteType::class, $suite, ["chapSrc" => $src, "chapDest" => $dest]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($suite);
            $em->flush();

            return $this->redirectToRoute("histoire_show", ['id' => $src->getHistoire()->getId()]);
        }
        return $this->render('suite/new.html.twig', [
            'suite' => $suite,
            'formCreerSuite' => $form->createView(),
        ]);

    }
}