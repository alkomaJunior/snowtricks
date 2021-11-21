<?php

namespace App\Service;

use App\Entity\Media;
use App\Entity\Trick;
use App\Entity\User;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MediaUploader
{
    private $targetDir;
    private $slugger;
    protected $requestStack;

    public function __construct(string $mediasDir, SluggerInterface $slugger, RequestStack $requestStack)
    {
        $this->targetDir = $mediasDir;
        $this->slugger = $slugger;
        $this->requestStack = $requestStack;
    }

    /**
     * @return string
     */
    public function getTargetDir(): string
    {
        return $this->targetDir;
    }

    /**
     * @param string $targetDir
     */
    public function setTargetDir(string $targetDir): void
    {
        $this->targetDir = $targetDir;
    }

    /**
     * @return SluggerInterface
     */
    public function getSlugger(): SluggerInterface
    {
        return $this->slugger;
    }

    /**
     * @param RequestStack $requestStack
     */
    public function setRequestStack(RequestStack $requestStack): void
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @return RequestStack
     */
    public function getRequestStack(): RequestStack
    {
        return $this->requestStack;
    }

    /**
     * @param SluggerInterface $slugger
     */
    public function setSlugger(SluggerInterface $slugger): void
    {
        $this->slugger = $slugger;
    }

    public function upload(array $medias, Trick $trick)
    {
        foreach ($medias as $index => $media) {
            $originalFileName = pathinfo($media, PATHINFO_FILENAME);
            $safeFileName = $this->slugger->slug($originalFileName);
            $fileName = $safeFileName.'-'.uniqid().'.'.$media->guessExtension();

            try {
                $media->move($this->getTargetDir(), $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $mediaFile = new Media();

            $request = $this->requestStack->getCurrentRequest();

            (
                strpos($fileName, 'jpg')
                || strpos($fileName, 'png')
                || strpos($fileName, 'jpeg')
            ) ? $mediaFile->setMediaType("Image") :
                $mediaFile->setMediaType("Video");

            $mediaFile->setMediaFileName($fileName);
            $mediaFile->setSlug(strtolower(preg_replace('/\s+/', '', $fileName)));

            ($index === 0 && $request->getPathInfo() === "/trick/new") ?
                $mediaFile->setIsFrontPageMedia(true) : $mediaFile->setIsFrontPageMedia(false);

            $trick->addMedium($mediaFile);
        }
    }

    public function uploadByUrl(string $mediaUrl, Trick $trick)
    {
        $mediaFile = new Media();

        (
            strpos($mediaUrl, 'jpg')
            || strpos($mediaUrl, 'png')
            || strpos($mediaUrl, 'jpeg')
            || strpos($mediaUrl, 'svg')
        ) ? $mediaFile->setMediaType("Image") :
            $mediaFile->setMediaType("Video");

        $mediaFile->setMediaUrl($mediaUrl);

        $mediaFile->setSlug("myMediaLink".$mediaFile->getId());
        $mediaFile->setIsFrontPageMedia(false);

        $trick->addMedium($mediaFile);
    }

    public function uploadAvatar($media, User $user)
    {
        $originalFileName = pathinfo($media, PATHINFO_FILENAME);
        $safeFileName = $this->slugger->slug($originalFileName);
        $fileName = $safeFileName.'-'.uniqid().'.'.$media->guessExtension();

        try {
            $media->move($this->getTargetDir(), $fileName);
            if (!empty($user->getAvatar())) {
                unlink($this->getTargetDir().'/'.$user->getAvatar());
            }
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        $user->setAvatar($fileName);
    }
}
