<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Slug;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 * @ORM\Table(name="`videos`")
 * @ORM\HasLifecycleCallbacks()
 */
class Video
{
    use Slug;
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videoFileName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videoUrl;


    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="video")
     */
    private $trick;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoFileName(): ?string
    {
        return $this->videoFileName;
    }

    public function setVideoFileName(string $videoFileName): self
    {
        $this->videoFileName = $videoFileName;

        return $this;
    }

    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(string $videoUrl): self
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }
}
