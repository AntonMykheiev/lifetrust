<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Button;
use Symfony\Component\HttpFoundation\Response;

class ButtonController extends AbstractController
{
    /**
     * @Route("/button", name="button")
     */
    public function index()
    {
        return $this->render('button/index.html.twig', [
            'controller_name' => 'ButtonController',
        ]);
    }

    public function createButton(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $button = new Button();
        $button->setName($data['name']);
        $button->setUrl($data['url']);
        $button->setHomeBlock($data['homeBlock']);
        $button->setBanner($data['banner']);
        $button->setImage($data['image']);

        $entityManager->persist($button);

        $entityManager->flush();

        return new Response('Saved new button with id '.$button->getId());
    }

    public function updateButton($id, Request $request) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $button = $entityManager->getRepository(Button::class)->find($id);

        $data = json_decode($request->getContent(), true);

        $button->setName($data['name']);
        $button->setUrl($data['url']);
        $button->setHomeBlock($data['homeBlock']);
        $button->setBanner($data['banner']);
        $button->setImage($data['image']);

        $entityManager->persist($button);

        $entityManager->flush();

        return new Response($button->getId() . "button updated!");

    }

    public function deleteButton($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $button = $entityManager->getRepository(Button::class)->find($id);

        $entityManager->remove($button);
        $entityManager->flush();

        return new Response($button->getId() . "button deleted!");
    }
}
