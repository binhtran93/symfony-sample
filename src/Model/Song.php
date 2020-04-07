<?php


namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Song
{
    /**
     * @Assert\Email
     */
    private $title;
    private $artwork;
    private $streamUrl;
    private $createdAt;
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getArtwork()
    {
        return $this->artwork;
    }

    /**
     * @param mixed $artwork
     */
    public function setArtwork($artwork): void
    {
        $this->artwork = $artwork;
    }

    /**
     * @return mixed
     */
    public function getStreamUrl()
    {
        return $this->streamUrl;
    }

    /**
     * @param mixed $streamUrl
     */
    public function setStreamUrl($streamUrl): void
    {
        $this->streamUrl = $streamUrl;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }


}