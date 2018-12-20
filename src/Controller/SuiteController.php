<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 19/12/2018
 * Time: 17:03
 */


namespace App\Controller;
use App\Entity\Suite;
use App\Entity\Chapitre;
use App\Form\SuiteType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Request;
use App\Security\AppAccess;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/suite")
 */
class SuiteController extends AbstractController
{

    /**
     * @Route("/new/{source_id}/{dest_id}",name="suite_new", methods="GET|POST"))
     */
    public function new(Request $request, Chapitre $src , Chapitre $dest ) : Response
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