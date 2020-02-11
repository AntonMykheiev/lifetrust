<?php

namespace App\Controller;

use App\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     */
    public function index()
    {
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }

    public function createServices(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $services = new Services();
        $services->setContent($data['content']);
        $services->setImage($data['image']);
        $services->setTitle($data['title']);
        $services->setDescription($data['description']);

        $entityManager->persist($services);

        $entityManager->flush();

        return new Response('Saved new service with id '.$services->getId());
    }

    public function updateServices($id, Request $request) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $services = $entityManager->getRepository(Services::class)->find($id);

        $data = json_decode($request->getContent(), true);

        $services->set($data['name']);
        $services->setImage($data['image']);
        $services->setText($data['text']);

        $entityManager->persist($services);

        $entityManager->flush();

        return new Response($services->getId() . "service updated!");

    }

    public function deleteBanner($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $services = $entityManager->getRepository(Services::class)->find($id);

        $entityManager->remove($services);
        $entityManager->flush();

        return new Response($services->getId() . "service deleted!");
    }
}
