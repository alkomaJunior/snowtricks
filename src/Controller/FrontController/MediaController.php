<?php

namespace App\Controller\FrontController;

use App\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends AbstractController
{
    /**
     * @Route("/front_img/{trickId}", name="front_img", methods={"GET"})
     * @param int $trickId
     * @return Response
     */
    public function frontPageImage(int $trickId): Response
    {
        $frontPageImg = $this->getDoctrine()->getRepository(Media::class)->findOneBy([
            'trick' => $trickId,
            'isFrontPageMedia' => true
        ]);

        return $this->render('front/trick/_frontPageMedia.html.twig', [
            'frontPageImg' => $frontPageImg
        ]);
    }
}
