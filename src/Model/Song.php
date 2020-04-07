<?php


namespace App\Model;


class Song
{
    private $title;
    private $artwork;
    private $streamUrl;

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


}