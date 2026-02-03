<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FleurController extends AbstractController
{
    #[Route('/fleur', name: 'app_flower')]
    public function index(): Response
    {
        return $this->render('flowers/flower.html.twig');
    }

    #[Route('/fleur/list', name: 'app_flower_list')]
    public function list(Request $request): Response
    {
        $valeur = $request->query->get('nom', 'aucune valeur');
        return $this->render(
            'flowers/flower.list.html.twig', 
            [
            'flowerName' => $valeur,
            'author' => 'MDevoldere'
            ]
        );
    }

    #[Route('/fleur/show', name: 'app_flower_show_std')]
    public function showStd(): Response
    {
        return $this->render('flowers/flower.show.html.twig', ['flowerId' => 0]);
    }

    #[Route('/flower/show/{id}', name: 'app_flower_show')]
    public function show(int $id): Response
    {
        return $this->render('flowers/flower.show.html.twig', ['flowerId' => $id]);
    }
}
