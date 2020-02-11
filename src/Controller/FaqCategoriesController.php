<?php

namespace App\Controller;

use App\Entity\FaqCategories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqCategoriesController extends AbstractController
{
    /**
     * @Route("/faqcategories", name="faq_categories")
     */
    public function index()
    {
        return $this->render('faq_categories/index.html.twig', [
            'controller_name' => 'FaqCategoriesController',
        ]);
    }

    public function createFaqCategories(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $faqCategories = new FaqCategories();
        $faqCategories->setIsActive($data['isActive']);
        $faqCategories->setName($data['name']);
        $faqCategories->setOrder($data['order']);

        $entityManager->persist($faqCategories);

        $entityManager->flush();

        return new Response('Saved new category with id '.$faqCategories->getId());
    }

    public function updateFaqCategories($id, Request $request) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $faqCategories = $entityManager->getRepository(FaqCategories::class)->find($id);

        $data = json_decode($request->getContent(), true);

        $faqCategories->setIsActive($data['isActive']);
        $faqCategories->setName($data['name']);
        $faqCategories->setOrder($data['order']);

        $entityManager->persist($faqCategories);

        $entityManager->flush();

        return new Response($faqCategories->getId() . "category updated!");

    }

    public function deleteFaqCategories($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $faqCategories = $entityManager->getRepository(FaqCategories::class)->find($id);

        $entityManager->remove($faqCategories);
        $entityManager->flush();

        return new Response($faqCategories->getId() . "category deleted!");
    }
}
