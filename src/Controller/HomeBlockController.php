<?php

namespace App\Controller;

use App\Entity\HomeBlock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeBlockController extends AbstractController
{
    /**
     * @Route("/home/block", name="home_block")
     */
    public function index()
    {
        return $this->render('home_block/index.html.twig', [
            'controller_name' => 'HomeBlockController',
        ]);
    }

    public function createDynamicPage(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $homeBlock = new HomeBlock();
        $homeBlock->setTitle($data['title']);
        $homeBlock->setImage($data['image']);
        $homeBlock->setContent($data['content']);

        $entityManager->persist($homeBlock);

        $entityManager->flush();

        return new Response('Saved new home block with id '.$homeBlock->getId());
    }

    public function updateDynamicPage($id, Request $request) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $homeBlock = $entityManager->getRepository(HomeBlock::class)->find($id);

        $data = json_decode($request->getContent(), true);

        $homeBlock->setTitle($data['title']);
        $homeBlock->setImage($data['image']);
        $homeBlock->setContent($data['content']);

        $entityManager->persist($homeBlock);

        $entityManager->flush();

        return new Response($homeBlock->getId() . "home block updated!");

    }

    public function deleteDynamicPage($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $homeBlock = $entityManager->getRepository(HomeBlock::class)->find($id);

        $entityManager->remove($homeBlock);
        $entityManager->flush();

        return new Response($homeBlock->getId() . "home block deleted!");
    }
}
