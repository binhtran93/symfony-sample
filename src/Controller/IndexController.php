<?php


namespace App\Controller;

use App\Model\Song;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/exception")
     */
    public function testHandleException() {
        throw new BadRequestHttpException('thrown');
    }

    public function testSerialize() {
        $song = new Song();
        $song->setTitle("Not Afraid");
        $song->setArtwork('dump_url');
        $song->setStreamUrl("other dump url");


    }
}