<?php


namespace App\Controller\Api;


use App\Entity\Album;
use App\Entity\Song;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SongController extends AbstractController
{
    /**
     * @Route("/songs/create")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function create() {
        $song = new Song();
        $song->setTitle("Not afraid");
        $song->setStreamUrl("bla");
        $song->setArtworkUrl("artwork");
        $song->setCreatedAt(new \DateTime());

        $em = $this->getDoctrine()->getManager();

        $album = new Album();
        $album->setName("Encore");

//        $song->setAlbum($album);
        $album->addSong($song);
        $em->persist($album);
        $em->persist($song);

        $em->flush();

        return $this->json([
            'success' => 1
        ]);
    }

    /**
     * @Route("/songs/list")
     */
    public function index(SerializerInterface $serializer) {
        $em = $this->getDoctrine()->getManager();


        $songs = $em->getRepository(Song::class)->findAll();

        return $this->json($songs);
    }
}