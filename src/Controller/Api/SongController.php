<?php


namespace App\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    /**
     * @Route("/songs/{id}")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function show($id) {
        return $this->json([
            'test' => 1
        ]);
    }
}