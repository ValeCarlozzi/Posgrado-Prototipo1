<?php

namespace App\Controller;

use App\Entity\DictadoCurso;
use App\Form\DictadoCursoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/dictados')]
class DictadoCursoController extends AbstractController
{
    #[Route('', name: 'dictado_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $dictados = $em->getRepository(DictadoCurso::class)->findAll();
        return $this->render('dictado/index.html.twig', [
            'dictados' => $dictados,
        ]);
    }

    #[Route('/new', name: 'dictado_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $dictado = new DictadoCurso();
        $form = $this->createForm(DictadoCursoType::class, $dictado);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dictado);
            $em->flush();
            return $this->redirectToRoute('dictado_index');
        }
        return $this->render('dictado/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'dictado_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DictadoCurso $dictado, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(DictadoCursoType::class, $dictado);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('dictado_index');
        }
        return $this->render('dictado/edit.html.twig', [
            'form' => $form->createView(),
            'dictado' => $dictado,
        ]);
    }

    #[Route('/{id}/delete', name: 'dictado_delete', methods: ['POST'])]
    public function delete(Request $request, DictadoCurso $dictado, EntityManagerInterface $em): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$dictado->getId(), $request->request->get('_token'))) {
            $em->remove($dictado);
            $em->flush();
        }
        return $this->redirectToRoute('dictado_index');
    }

    #[Route('/{id}', name: 'dictado_show', methods: ['GET'])]
    public function show(DictadoCurso $dictado): Response
    {
        return $this->render('dictado/show.html.twig', [
            'dictado' => $dictado,
        ]);
    }
} 