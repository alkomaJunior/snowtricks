<?php

namespace App\Controller\FrontController;

use App\Entity\Media;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use App\Repository\TrickRepository;
use Doctrine\DBAL\Driver\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/media")
 */
class MediaController extends AbstractController
{
    private $translator;
    private $slugger;

    public function __construct(TranslatorInterface $translator, SluggerInterface $slugger)
    {
        $this->translator = $translator;
        $this->slugger = $slugger;
    }

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

    /**
     * @Route("/{slug}/edit", name="media_edit", methods={"GET","POST"})
     */
    public function edit(
        Request $request,
        Media $media,
        MediaRepository $mediaRepository,
        TrickRepository $trickRepository,
        string $mediasDir
    ): Response {

        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');

        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        $trick = $trickRepository->findOneBy(['id' => $media->getTrick()->getId()]);

        if ($form->isSubmitted() && $form->isValid()) {
            $mediaFromForm = $form["media"]->getData();
            $mediaStatus = $media->getIsFrontPageMedia();

            if ($mediaStatus) {
                try {
                    $restOfMedias = $mediaRepository->findAllMediasExceptedOne($media->getId());
                    foreach ($restOfMedias as $restOfMedia) {
                        $restOfMedia->setIsFrontPageMedia(false);
                    }
                    $this->getDoctrine()->getManager()->flush();
                } catch (Exception | \Doctrine\DBAL\Exception $e) {
                }
            }

            if ($mediaFromForm) {
                $originalFileName = pathinfo($mediaFromForm, PATHINFO_FILENAME);
                $safeFileName = $this->slugger->slug($originalFileName);
                $fileName = $safeFileName.'-'.uniqid().'.'.$mediaFromForm->guessExtension();

                try {
                    $mediaFromForm->move($mediasDir, $fileName);
                    unlink($mediasDir.'/'.$media->getMediaFileName());
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $media->setMediaFileName($fileName);
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success", $this->translator->trans('Media has been successfully updated'));
            return $this->redirectToRoute('myTricks', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/media/edit.html.twig', [
            'trick' => $trick,
            'media' => $media,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="media_delete", methods={"POST"})
     */
    public function delete(Request $request, Media $media, string $mediasDir): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');

        $csrfId = sprintf("delete%s", $media->getSlug());

        if ($this->isCsrfTokenValid($csrfId, $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            if (empty($media->getMediaUrl())) {
                try {
                    unlink($mediasDir.'/'.$media->getMediaFileName());
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }
            $entityManager->remove($media);
            $entityManager->flush();
        }

        $this->addFlash("success", $this->translator->trans('Media has been successfully deleted'));
        return $this->redirectToRoute('myTricks', [], Response::HTTP_SEE_OTHER);
    }
}
