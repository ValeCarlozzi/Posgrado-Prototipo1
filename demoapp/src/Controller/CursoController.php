<?php

namespace App\Controller;

use App\Entity\Curso;
use App\Form\CursoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/cursos')]
class CursoController extends AbstractController
{
    #[Route('', name: 'curso_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $cursos = $em->getRepository(Curso::class)->findAll();
        return $this->render('curso/index.html.twig', [
            'cursos' => $cursos,
        ]);
    }

    #[Route('/new', name: 'curso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $curso = new Curso();
        $form = $this->createForm(CursoType::class, $curso);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($curso);
            $em->flush();
            return $this->redirectToRoute('curso_index');
        }
        return $this->render('curso/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'curso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Curso $curso, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CursoType::class, $curso);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('curso_index');
        }
        return $this->render('curso/edit.html.twig', [
            'form' => $form->createView(),
            'curso' => $curso,
        ]);
    }

    #[Route('/{id}/delete', name: 'curso_delete', methods: ['POST'])]
    public function delete(Request $request, Curso $curso, EntityManagerInterface $em): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$curso->getId(), $request->request->get('_token'))) {
            $em->remove($curso);
            $em->flush();
        }
        return $this->redirectToRoute('curso_index');
    }

    #[Route('/{id}', name: 'curso_show', methods: ['GET'])]
    public function show(Curso $curso): Response
    {
        return $this->render('curso/show.html.twig', [
            'curso' => $curso,
        ]);
    }
} 