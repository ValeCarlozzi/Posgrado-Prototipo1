<?php

namespace App\Controller;

use App\Entity\Tarifa;
use App\Form\TarifaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/tarifas')]
class TarifaController extends AbstractController
{
    #[Route('', name: 'tarifa_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $tarifas = $em->getRepository(Tarifa::class)->findAll();
        return $this->render('tarifa/index.html.twig', [
            'tarifas' => $tarifas,
        ]);
    }

    #[Route('/new', name: 'tarifa_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $tarifa = new Tarifa();
        $form = $this->createForm(TarifaType::class, $tarifa);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tarifa);
            $em->flush();
            return $this->redirectToRoute('tarifa_index');
        }
        return $this->render('tarifa/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'tarifa_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tarifa $tarifa, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(TarifaType::class, $tarifa);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('tarifa_index');
        }
        return $this->render('tarifa/edit.html.twig', [
            'form' => $form->createView(),
            'tarifa' => $tarifa,
        ]);
    }

    #[Route('/{id}/delete', name: 'tarifa_delete', methods: ['POST'])]
    public function delete(Request $request, Tarifa $tarifa, EntityManagerInterface $em): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$tarifa->getId(), $request->request->get('_token'))) {
            $em->remove($tarifa);
            $em->flush();
        }
        return $this->redirectToRoute('tarifa_index');
    }

    #[Route('/{id}', name: 'tarifa_show', methods: ['GET'])]
    public function show(Tarifa $tarifa): Response
    {
        return $this->render('tarifa/show.html.twig', [
            'tarifa' => $tarifa,
        ]);
    }
} 