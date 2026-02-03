<?php

namespace App\Controller;

use App\Entity\Flower;
use App\Form\FlowerType;
use App\Repository\FlowerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/my/flowers')]
final class MyFlowersController extends AbstractController
{
    #[Route(name: 'app_my_flowers_index', methods: ['GET'])]
    public function index(FlowerRepository $flowerRepository): Response
    {
        return $this->render('my_flowers/index.html.twig', [
            'flowers' => $flowerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_my_flowers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $flower = new Flower();
        $form = $this->createForm(FlowerType::class, $flower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($flower);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_flowers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('my_flowers/new.html.twig', [
            'flower' => $flower,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_my_flowers_show', methods: ['GET'])]
    public function show(Flower $flower): Response
    {
        return $this->render('my_flowers/show.html.twig', [
            'flower' => $flower,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_my_flowers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Flower $flower, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FlowerType::class, $flower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_my_flowers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('my_flowers/edit.html.twig', [
            'flower' => $flower,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_my_flowers_delete', methods: ['POST'])]
    public function delete(Request $request, Flower $flower, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flower->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($flower);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_my_flowers_index', [], Response::HTTP_SEE_OTHER);
    }
}
