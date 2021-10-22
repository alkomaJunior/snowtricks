<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;
use App\Entity\Traits\Slug;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 * @ORM\Table(name="`medias`")
 */
class Media
{

    use Timestampable;
    use Slug;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $mediaFileName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $mediaUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $mediaType;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isFrontPageMedia;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="media")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Trick $trick;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMediaFileName(): ?string
    {
        return $this->mediaFileName;
    }

    public function setMediaFileName(?string $mediaFileName): self
    {
        $this->mediaFileName = $mediaFileName;

        return $this;
    }

    public function getMediaUrl(): ?string
    {
        return $this->mediaUrl;
    }

    public function setMediaUrl(?string $mediaUrl): self
    {
        $this->mediaUrl = $mediaUrl;

        return $this;
    }

    public function getMediaType(): ?string
    {
        return $this->mediaType;
    }

    public function setMediaType(string $mediaType): self
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    public function getIsFrontPageMedia(): ?bool
    {
        return $this->isFrontPageMedia;
    }

    public function setIsFrontPageMedia(bool $isFrontPageMedia): self
    {
        $this->isFrontPageMedia = $isFrontPageMedia;

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
