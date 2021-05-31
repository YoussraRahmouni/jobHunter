<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddInfoCompanyController extends AbstractController
{
    /**
     * @Route("/add/info/company", name="add_info_company")
     */
    public function index(): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('add_info_company/index.html.twig', [
            'controller_name' => 'AddInfoCompanyController',
        ]);
    }
}
