<?php

namespace App\Controller\FrontController;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('front/trick/index.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }
}
