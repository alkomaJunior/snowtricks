<?php

namespace App\Controller\FrontController;

use App\Repository\TrickRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET", "POST"})
     */
    public function index(TrickRepository $trickRepository): Response
    {

        //$offset = max(0, $request->query->getInt('offset', 0));
        isset($_POST['offset']) ? $offset = filter_input(INPUT_POST, 'offset') :
            $offset = 0;
        $tricksPaginated = $trickRepository->getTricksPaginated($offset);

        return $this->render('front/trick/index.html.twig', [
            'tricksPaginated'    => $tricksPaginated,
            'offset'             => $offset,
            'allTricks'          => $trickRepository->findAll(),
        ]);
    }
}
