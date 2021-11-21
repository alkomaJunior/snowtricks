<?php

namespace App\Controller\FrontController;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/", name="comment_index", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');

        return $this->render('front/comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }
}
