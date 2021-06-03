<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Offer;
use App\Entity\User;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offer")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/home", name="offer_index", methods={"GET"})
     */
    public function index(OfferRepository $offerRepository): Response
    {
        // returns list of offers of the company
        return $this->render('offer/offers.html.twig', [
            'offers' => $offerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="offer_new", methods={"GET","POST"})
     */
    public function new(Request $request, CompanyRepository $companyRepository): Response
    {

        $offer = new Offer();
        $user = new User();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        
        $company=$this->getUser()->getCompany();


        if ($form->isSubmitted() && $form->isValid()) {

            if(!is_null($offer)){

                $company=$this->getUser()->getCompany();
                $offer->setCompany($company);

                //save
                $em = $this->getDoctrine()->getManager();
                $em->persist($offer);
                $em->flush();


            } else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($offer);
                $em->flush();

            }





            return $this->redirectToRoute('offer_index');
        }

        return $this->render('offer/add_offre.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offer_show", methods={"GET"})
     */
    public function show(Offer $offer): Response
    {
        return $this->render('offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="offer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offer $offer): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offer_index');
        }

        return $this->render('offer/modify_offre.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offer_delete", methods={"POST"})
     */
    public function delete(Request $request, Offer $offer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offer_index');
    }
}
