<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeCompanyController extends AbstractController
{
    /**
     * @Route("/home/company", name="home_company")
     */
    public function index(): Response
    {
        return $this->render('home_company/home_company.html.twig', [
            'controller_name' => 'HomeCompanyController',
        ]);
    }
}
