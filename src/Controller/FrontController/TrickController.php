<?php

namespace App\Controller\FrontController;

use App\Entity\Media;
use App\Entity\Trick;
use App\Entity\User;
use App\Form\TrickType;
use App\Service\MediaUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/trick")
 */
class TrickController extends AbstractController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @Route("/new", name="trick_new", methods={"GET","POST"})
     * @param Request $request
     * @param MediaUploader $mediaUploader
     * @return Response
     */
    public function new(Request $request, MediaUploader $mediaUploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');

        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $this->getUser();
            $trick->setSlug(strtolower(preg_replace('/\s+/', '', $trick->getName())));
            $trick->setUser($user);

            $medias = $form["media"]->getData();
            $mediaUrl = $form["mediaUrl"]->getData();

            if ($mediaUrl) {
                $mediaUploader->uploadByUrl($mediaUrl, $trick);
            }

            if ($medias) {
                $mediaUploader->upload($medias, $trick);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trick);
            $entityManager->flush();

            $this->addFlash("success", $this->translator->trans('Trick has been successfully created'));
            return $this->redirectToRoute('myTricks', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/trick/new.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{slug}", name="trick_show", methods={"GET"})
     */
    public function show(Trick $trick): Response
    {
        return $this->render('front/trick/show.html.twig', [
            'trick' => $trick,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="trick_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Trick $trick, MediaUploader $mediaUploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');

        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medias = $form["media"]->getData();

            if ($medias) {
                $mediaUploader->upload($medias, $trick);
            }

            $mediaUrl = $form["mediaUrl"]->getData();

            if ($mediaUrl) {
                $mediaUploader->uploadByUrl($mediaUrl, $trick);
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success", $this->translator->trans('Trick has been successfully updated'));
            return $this->redirectToRoute('myTricks', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="trick_delete", methods={"POST"})
     */
    public function delete(Request $request, Trick $trick): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');

        $csrfId = sprintf("delete%s", $trick->getSlug());

        if ($this->isCsrfTokenValid($csrfId, $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trick);
            $entityManager->flush();
        }

        $this->addFlash("success", $this->translator->trans('Trick has been successfully deleted'));
        return $this->redirectToRoute('myTricks', [], Response::HTTP_SEE_OTHER);
    }
}
