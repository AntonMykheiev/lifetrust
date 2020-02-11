<?php

namespace App\Controller;

use App\Entity\DynamicPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DynamicPageController extends AbstractController
{
    /**
     * @Route("/dynamic/page", name="dynamic_page")
     */
    public function index()
    {
        return $this->render('dynamic_page/index.html.twig', [
            'controller_name' => 'DynamicPageController',
        ]);
    }

    public function createDynamicPage(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $dynamicPage = new DynamicPage();
        $dynamicPage->setUrl($data['name']);
        $dynamicPage->setContent($data['image']);
        $dynamicPage->setQuote($data['text']);
        $dynamicPage->setTitle($data['title']);

        $entityManager->persist($dynamicPage);

        $entityManager->flush();

        return new Response('Saved new banner with id '.$dynamicPage->getId());
    }

    public function updateDynamicPage($id, Request $request) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $dynamicPage = $entityManager->getRepository(DynamicPage::class)->find($id);

        $data = json_decode($request->getContent(), true);

        $dynamicPage->setUrl($data['name']);
        $dynamicPage->setContent($data['image']);
        $dynamicPage->setQuote($data['text']);
        $dynamicPage->setTitle($data['title']);

        $entityManager->persist($dynamicPage);

        $entityManager->flush();

        return new Response($dynamicPage->getId() . "banner updated!");

    }

    public function deleteDynamicPage($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $dynamicPage = $entityManager->getRepository(DynamicPage::class)->find($id);

        $entityManager->remove($dynamicPage);
        $entityManager->flush();

        return new Response($dynamicPage->getId() . "banner deleted!");
    }
}
