<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 19/12/2018
 * Time: 17:03
 */


namespace App\Controller;

use App\Entity\Chapitre;
use App\Entity\Histoire;
use App\Entity\Suite;
use App\Form\ChapitreType;
use App\Form\SuiteType;
use App\Security\AppAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Upload\FileChapitreTypeUpload;
use Symfony\Component\Routing\Annotation\Route;

class SuiteController extends AbstractController
{
    /**
     * @Route("/suite/new/{src}/{dest}", name="suite_new", methods="GET|POST"))
     */
    public function new(Request $request, $src, $dest)
    {
        $suite = new Suite();

        $repository = $this->getDoctrine()->getRepository(Chapitre::class);
        $chapSRC = $repository->find($src);
        $chapDIST = $repository->find($dest);

        $this->denyAccessUnlessGranted(AppAccess::CHAPITRE_EDIT, $chapSRC);
        $this->denyAccessUnlessGranted(AppAccess::CHAPITRE_EDIT, $chapDIST);


        $form = $this->createForm(SuiteType::class, $suite, ['src' => $chapSRC, "dest" => $chapDIST]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($suite);
            $em->flush();

            // return $this->redirectToRoute("histoire_show", ['id' => $src->getHistoire()->getId()]);
        }
        return $this->render('suite/new.html.twig', [
            'suite' => $suite,
            'formCreerSuite' => $form->createView(),
        ]);

    }
}