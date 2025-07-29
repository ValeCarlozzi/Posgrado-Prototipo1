<?php

namespace App\Controller;

use App\Entity\Nota;
use App\Form\NotaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/notas')]
class NotaController extends AbstractController
{
    #[Route('', name: 'nota_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $notas = $em->getRepository(Nota::class)->findAll();
        return $this->render('nota/index.html.twig', [
            'notas' => $notas,
        ]);
    }

    #[Route('/new', name: 'nota_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $nota = new Nota();
        $form = $this->createForm(NotaType::class, $nota);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($nota);
            $em->flush();
            return $this->redirectToRoute('nota_index');
        }
        return $this->render('nota/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'nota_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nota $nota, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(NotaType::class, $nota);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('nota_index');
        }
        return $this->render('nota/edit.html.twig', [
            'form' => $form->createView(),
            'nota' => $nota,
        ]);
    }

    #[Route('/{id}/delete', name: 'nota_delete', methods: ['POST'])]
    public function delete(Request $request, Nota $nota, EntityManagerInterface $em): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$nota->getId(), $request->request->get('_token'))) {
            $em->remove($nota);
            $em->flush();
        }
        return $this->redirectToRoute('nota_index');
    }

    #[Route('/{id}', name: 'nota_show', methods: ['GET'])]
    public function show(Nota $nota): Response
    {
        return $this->render('nota/show.html.twig', [
            'nota' => $nota,
        ]);
    }
} 