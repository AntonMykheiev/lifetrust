<?php

namespace App\Controller;

use App\Entity\FaqQuestionAnswer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqQuestionAnswerController extends AbstractController
{
    /**
     * @Route("/faqquestionanswer", name="faq_question_answer")
     */
    public function index()
    {
        return $this->render('faq_question_answer/index.html.twig', [
            'controller_name' => 'FaqQuestionAnswerController',
        ]);
    }

    public function createFaqQuestionAnswer(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $faqQuestionAnswer = new FaqQuestionAnswer();
        $faqQuestionAnswer->setIsActive($data['isActive']);
        $faqQuestionAnswer->setQuestion($data['question']);
        $faqQuestionAnswer->setAnswer($data['answer']);
        $faqQuestionAnswer->setCategory($data['category']);

        $entityManager->persist($faqQuestionAnswer);

        $entityManager->flush();

        return new Response('Saved new question/answer with id '.$faqQuestionAnswer->getId());
    }

    public function updateFaqQuestionAnswer($id, Request $request) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $faqQuestionAnswer = $entityManager->getRepository(FaqQuestionAnswer::class)->find($id);

        $data = json_decode($request->getContent(), true);

        $faqQuestionAnswer->setIsActive($data['isActive']);
        $faqQuestionAnswer->setQuestion($data['question']);
        $faqQuestionAnswer->setAnswer($data['answer']);
        $faqQuestionAnswer->setCategory($data['category']);

        $entityManager->persist($faqQuestionAnswer);

        $entityManager->flush();

        return new Response($faqQuestionAnswer->getId() . "question/answer updated!");

    }

    public function deleteFaqQuestionAnswer($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $faqQuestionAnswer = $entityManager->getRepository(FaqQuestionAnswer::class)->find($id);

        $entityManager->remove($faqQuestionAnswer);
        $entityManager->flush();

        return new Response($faqQuestionAnswer->getId() . "question/answer deleted!");
    }
}
