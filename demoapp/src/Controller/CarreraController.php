<?php

namespace App\Controller;

use App\Entity\Carrera;
use App\Form\CarreraType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/carreras')]
class CarreraController extends AbstractController
{
    #[Route('', name: 'carrera_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $carreras = $em->getRepository(Carrera::class)->findAll();
        return $this->render('carrera/index.html.twig', [
            'carreras' => $carreras,
        ]);
    }

    #[Route('/new', name: 'carrera_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $carrera = new Carrera();
        $form = $this->createForm(CarreraType::class, $carrera);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($carrera);
            $em->flush();
            return $this->redirectToRoute('carrera_index');
        }
        return $this->render('carrera/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'carrera_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carrera $carrera, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CarreraType::class, $carrera);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('carrera_index');
        }
        return $this->render('carrera/edit.html.twig', [
            'form' => $form->createView(),
            'carrera' => $carrera,
        ]);
    }

    #[Route('/{id}/delete', name: 'carrera_delete', methods: ['POST'])]
    public function delete(Request $request, Carrera $carrera, EntityManagerInterface $em): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$carrera->getId(), $request->request->get('_token'))) {
            $em->remove($carrera);
            $em->flush();
        }
        return $this->redirectToRoute('carrera_index');
    }

    #[Route('/{id}', name: 'carrera_show', methods: ['GET'])]
    public function show(Carrera $carrera): Response
    {
        return $this->render('carrera/show.html.twig', [
            'carrera' => $carrera,
        ]);
    }
} 