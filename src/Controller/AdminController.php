<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
	  public function ShowAdmin(Request $request)
    {
        //Get repository like will be usefull to check our data and define the list of user/admin/assistance
      $repository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('App\Entity\MyDTDICTUser');

                                   


      $listUser = $repository->findAll();


      return new Response($this->render('admin.html.twig',array("users"=>$listUser)));
    }
}