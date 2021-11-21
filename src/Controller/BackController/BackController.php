<?php

namespace App\Controller\BackController;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    /**
     * @Route("comment/{slug}", name="comment_delete", methods={"POST"})
     */
    public function delete(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $csrfId = sprintf("delete%s", $comment->getSlug());

        if ($this->isCsrfTokenValid($csrfId, $request->request->get('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comment_index', [], Response::HTTP_SEE_OTHER);
    }
}
