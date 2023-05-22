<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\MakeAWishRepository;
use App\Repository\SerieRepository;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('', name: 'list')]
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findBy([], ["dateCreated" => "ASC"], 50);

        return $this->render('wish/list.html.twig', [
        'wishes' => $wishes
    ]);
    }

    #[Route('/{id}', name: 'detail', requirements: ["id" => "\d+"])]
    public function detail(int $id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);

        if (!$wish){
            throw $this->createNotFoundException("Le voeu que tu cherches n'existe pas...");
        }

        return $this->render('wish/detail.html.twig', [
            'wish' => $wish
        ]);
    }


    #[Route('/add', name: 'add')]
    public function add(Request $request, WishRepository $wishRepository): Response
    {
        $wish = new Wish();

        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);

        if ($wishForm->isSubmitted() && $wishForm->isValid()){

/*            $wish -> setDateCreated(new \DateTime());*/
            $wishRepository->save($wish, true);

            $this->addFlash('success', 'Le wish est ajouté !');
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return $this->render("wish/add.html.twig", [
            "wishForm" => $wishForm->createView()
        ]);

    }
}
