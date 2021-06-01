<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\AddInfoCmType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddInfoCompanyController extends AbstractController
{
    /**
     * @Route("/add/info/company", name="add_info_company")
     */
    public function index(Request $request): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $company = new Company();

        $currentUser = $this->getUser();
        // dump($currentUser);


        $form = $this->createForm(AddInfoCmType::class, $company);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            if(!is_null($company)){

                $currentUser = $this->getUser();
                $company->setUser($currentUser);

                //save
                $em = $this->getDoctrine()->getManager();
                $em->persist($company);
                $em->flush();


            } else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($company);
                $em->flush();
                $company->setUser($currentUser);
            }


            return $this->redirectToRoute('offer_index');
        }

        return $this->render('add_info_company/add_info_company.html.twig', [
            'user' => $this->getUser(),
            'form' => $form->createView(),
        ]);
    }
}
