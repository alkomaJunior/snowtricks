<?php

namespace App\Controller\FrontController;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(TrickRepository $trickRepository, Request $request): Response
    {

        $offset = $request->request->get('offset', 0);

        $tricksPaginated = $trickRepository->getTricksPaginated($offset);

        return $this->render('front/trick/index.html.twig', [
            'tricksPaginated'    => $tricksPaginated,
            'offset'             => $offset,
            'allTricks'          => $trickRepository->findAll(),
        ]);
    }
}
