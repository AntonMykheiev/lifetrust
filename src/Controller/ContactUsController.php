<?php

namespace App\Controller;

use App\Entity\ContactUs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactUsController extends AbstractController
{
    /**
     * @Route("/contact/us", name="contact_us")
     */
    public function index()
    {
        return $this->render('contact_us/index.html.twig', [
            'controller_name' => 'ContactUsController',
        ]);
    }

    public function createFeedback(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $feedback = new ContactUs();
        $feedback->setName($data['name']);
        $feedback->setEmail($data['image']);
        $feedback->setInquiry($data['text']);
        $feedback->setQuestion($data['question']);
        $feedback->setPhone($data['phone']);

        $entityManager->persist($feedback);

        $entityManager->flush();

        return new Response('Saved new feedback with id '.$feedback->getId());
    }
}
