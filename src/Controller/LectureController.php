<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 19/12/2018
 * Time: 17:03
 */


namespace App\Controller;

use App\Entity\Chapitre;
use App\Entity\Lecture;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LectureController extends AbstractController
{

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->token = $tokenStorage;
    }

    /**
     * @Route("/lecture/{id}", name="lecture_new")
     */
    public function newLecture(Chapitre $chapitre){
        $lecture = $em = $this->getDoctrine()->getManager()->getRepository(Lecture::class)
            ->findOneBy(['user' => $this->token->getToken()->getUser()]);

        if($lecture){
            $em = $this->getDoctrine()->getManager();
            $em->remove($lecture);
            $em->flush();
        }

        $lecture = new Lecture();
        $lecture->setChapitre($chapitre);
        $lecture->setHistoire($chapitre->getHistoire());
        $lecture->setUser($this->token->getToken()->getUser());
        $lecture->setNumSequence(0);
        $lecture->setDateLecture(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($lecture);
        $em->flush();

        return new Response($this->renderView('chapitre/show.html.twig',array("chapitre" => $chapitre)));
    }
}