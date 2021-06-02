<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\AddInfoStType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Service\FileUploader;



class AddInfoController extends AbstractController
{
    /**
     * @Route("/add/info", name="add_info")
     */
    public function index(Request $request, FileUploader $fileUploader): Response
    {


        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        if($this->getUser()->getStudent()){
            return $this->redirectToRoute('student_index');
        }




        $student = new Student();

        $currentUser = $this->getUser();
        // dump($currentUser);


        $form = $this->createForm(AddInfoStType::class, $student);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $student_cv */
            $student_cv = $form->get('student_cv')->getData();
            if ($student_cv) {
                $brochureFileName = $fileUploader->upload($student_cv);
                $student->setStudentCv($student_cv);
            }


            
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
