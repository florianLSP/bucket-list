<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('', name: 'list')]
    public function list(): Response
    {
        $wish1 = "Me marier avec Eva Gössinger";
        $wish2 = "Je veux une petite ile rien que pour moi et ma femme";
        return $this->render('wish/list.html.twig', [
        "wish1" => $wish1,
            "wish2" => $wish2
    ]);
    }

    #[Route('/{id}', name: 'detail', requirements: ["id" => "\d+"])]
    public function detail(int $id): Response
    {

        dump($id);
        return $this->render('wish/detail.html.twig');
    }
}
