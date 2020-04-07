<?php


namespace App\Controller;

use App\Form\Type\SongType;
use App\Model\Song;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class IndexController extends AbstractController
{
    /**
     * @Route("/exception")
     */
    public function testHandleException() {
        throw new BadRequestHttpException('thrown');
    }

    /**
     * @Route("/serialize")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function testSerialize() {
        $song = new Song();
        $song->setTitle("Not Afraid");
        $song->setArtwork('dump_url');
        $song->setStreamUrl("other dump url");
        $song->setCreatedAt(new \DateTime());

        $dateCallback = function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
            return $innerObject instanceof \DateTime ? $innerObject->format(\DateTime::ISO8601) : '';
        };

        $defaultContext = [
            AbstractNormalizer::CALLBACKS => [
                'createdAt' => $dateCallback,
            ],
        ];

        $encoders = [new XmlEncoder(), new JsonEncoder()];
//        $normalizer = new GetSetMethodNormalizer(null, null, null, null, null, $defaultContext);
        $normalizer = new GetSetMethodNormalizer(null, null, null, null, null, $defaultContext);
        $normalizers = [$normalizer];
        $normalizer->normalize($song);

        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($song, JsonEncoder::FORMAT);

        $songModel = $serializer->deserialize($json, Song::class, JsonEncoder::FORMAT);

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/create-songs", methods={"GET", "POST"})
     * @return Response
     * @throws \Exception
     */
    public function testCreateForm(Request $request) {
        $song = new Song();
        $song->setTitle("Not Afraid");
        $song->setArtwork('dump_url');
        $song->setStreamUrl("other dump url");
        $song->setCreatedAt(new \DateTime());

        $form = $this->createForm(SongType::class, $song);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return new Response("success");
        }

        return $this->render('song/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}