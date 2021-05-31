<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\AddInfoStType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddInfoController extends AbstractController
{
    /**
     * @Route("/add/info", name="add_info")
     */
    public function index(Request $request): Response
    {


        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }




        $student = new Student();

        $currentUser = $this->getUser();
        // dump($currentUser);


        $form = $this->createForm(AddInfoStType::class, $student);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            
            if(!is_null($student)){

                $currentUser = $this->getUser();
                $student->setUser($currentUser);
                
                //save
                $em = $this->getDoctrine()->getManager();
                $em->persist($student);
                $em->flush();
             
 
            } else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($student);
                $em->flush();
                $student->setUser($currentUser);
            }
            
            
            return $this->redirectToRoute('home_student');
        }

        return $this->render('add_info/add_info_student.html.twig', [
            'user' => $this->getUser(),
            'form' => $form->createView(),
        ]);
    }
}
