<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeStudentController extends AbstractController
{
    /**
     * @Route("/home/student", name="home_student")
     */
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('home_student/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
