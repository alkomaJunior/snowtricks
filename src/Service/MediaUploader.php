<?php

namespace App\Service;

use App\Entity\Media;
use App\Entity\Trick;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class MediaUploader
{
    private $targetDir;
    private $slugger;

    public function __construct(string $mediasDir, SluggerInterface $slugger)
    {
        $this->targetDir = $mediasDir;
        $this->slugger = $slugger;
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

            (
                strpos($fileName, 'jpg')
                || strpos($fileName, 'png')
                || strpos($fileName, 'jpeg')
            ) ? $mediaFile->setMediaType("Image") :
                $mediaFile->setMediaType("Video");

            $mediaFile->setMediaFileName($fileName);
            $mediaFile->setSlug(strtolower(preg_replace('/\s+/', '', $fileName)));

            ($index === 0) ? $mediaFile->setIsFrontPageMedia(true) : $mediaFile->setIsFrontPageMedia(false);

            $trick->addMedium($mediaFile);
        }
    }
}
