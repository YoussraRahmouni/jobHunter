<?php

namespace App\Controller;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeStudentController extends AbstractController
{
    /**
     * @Route("/home/student", name="home_student")
     */
    public function index(OfferRepository $offerRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('home_student/index.html.twig', [
            'user' => $this->getUser(),
            'offers' => $offerRepository->findAll(),
        ]);
    }
}
