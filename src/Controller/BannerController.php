<?php

namespace App\Controller;

use App\Entity\Banner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BannerController extends AbstractController
{
    /**
     * @Route("/banner", name="banner")
     */
    public function index()
    {
        return $this->render('banner/index.html.twig', [
            'controller_name' => 'BannerController',
        ]);
    }

    public function createBanner(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $banner = new Banner();
        $banner->setName($data['name']);
        $banner->setImage($data['image']);
        $banner->setText($data['text']);

        $entityManager->persist($banner);

        $entityManager->flush();

        return new Response('Saved new banner with id '.$banner->getId());
    }

    public function updateBanner($id, Request $request) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $banner = $entityManager->getRepository(Banner::class)->find($id);

        $data = json_decode($request->getContent(), true);

        $banner->setName($data['name']);
        $banner->setImage($data['image']);
        $banner->setText($data['text']);

        $entityManager->persist($banner);

        $entityManager->flush();

        return new Response($banner->getId() . "banner updated!");

    }

    public function deleteBanner($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $banner = $entityManager->getRepository(Banner::class)->find($id);

        $entityManager->remove($banner);
        $entityManager->flush();

        return new Response($banner->getId() . "banner deleted!");
    }
}
