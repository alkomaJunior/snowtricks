<?php

namespace App\Controller\FrontController;

use App\Entity\User;
use App\Repository\TrickRepository;
use App\Repository\UserRepository;
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



    /**
     * @Route("/my-tricks", name="myTricks", methods={"GET"})
     */
    public function myTricks(TrickRepository $trickRepository, Request $request): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');

        /** @var  User $user */
        $user = $this->getUser();

        $offset = $request->request->get('offset', 0);

        $tricksPaginated = $trickRepository->getTricksPaginatedByUser($offset, $user->getId());

        return $this->render('front/trick/myTricks.html.twig', [
            'tricksPaginated'    => $tricksPaginated,
            'offset'             => $offset,
            'myTricks'           => $trickRepository->findBy(['user' => $user->getId()]),
        ]);
    }
}
