<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 19/12/2018
 * Time: 14:20
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


class DeleteController extends AbstractController{

    /**
     * @Route("/delete/histoire/{id}", name="histoire_delete", methods="DELETE")
     */
    public function delete(Request $request, Histoire $histoire): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::HISTOIRE_DELETE, $histoire);
        if ($this->isCsrfTokenValid('delete'.$histoire->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();

            $repository = $this->getDoctrine()->getRepository(Chapitre::class);
            $chapitres = $repository->findBy(['histoire' => $histoire]);

            foreach ($chapitres as $chapitre){
                $em->remove($chapitre);
            }
            $em->remove($histoire);
            $em->flush();
        }

        return $this->redirectToRoute('visualisation');
    }
}