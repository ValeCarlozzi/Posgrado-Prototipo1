<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Alumno;
use App\Form\AlumnoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/alumnos')]
class AlumnoController extends AbstractController
{
    #[Route('', name: 'alumno_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $alumnos = $em->getRepository(Alumno::class)->findAll();
        return $this->render('alumno/index.html.twig', [
            'alumnos' => $alumnos,
        ]);
    }

    #[Route('/new', name: 'alumno_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $alumno = new Alumno();
        $form = $this->createForm(AlumnoType::class, $alumno);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($alumno);
            $em->flush();
            return $this->redirectToRoute('alumno_index');
        }
        return $this->render('alumno/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'alumno_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Alumno $alumno, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(AlumnoType::class, $alumno);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('alumno_index');
        }
        return $this->render('alumno/edit.html.twig', [
            'form' => $form->createView(),
            'alumno' => $alumno,
        ]);
    }

    #[Route('/{id}/delete', name: 'alumno_delete', methods: ['POST'])]
    public function delete(Request $request, Alumno $alumno, EntityManagerInterface $em): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$alumno->getId(), $request->request->get('_token'))) {
            $em->remove($alumno);
            $em->flush();
        }
        return $this->redirectToRoute('alumno_index');
    }

    #[Route('/{id}', name: 'alumno_show', methods: ['GET'])]
    public function show(Alumno $alumno): Response
    {
        return $this->render('alumno/show.html.twig', [
            'alumno' => $alumno,
        ]);
    }
} 