<?php

namespace App\Controller;

use App\Entity\Pago;
use App\Form\PagoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/pagos')]
class PagoController extends AbstractController
{
    #[Route('', name: 'pago_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $pagos = $em->getRepository(Pago::class)->findAll();
        return $this->render('pago/index.html.twig', [
            'pagos' => $pagos,
        ]);
    }

    #[Route('/new', name: 'pago_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $pago = new Pago();
        $form = $this->createForm(PagoType::class, $pago);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($pago);
            $em->flush();
            return $this->redirectToRoute('pago_index');
        }
        return $this->render('pago/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'pago_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pago $pago, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PagoType::class, $pago);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('pago_index');
        }
        return $this->render('pago/edit.html.twig', [
            'form' => $form->createView(),
            'pago' => $pago,
        ]);
    }

    #[Route('/{id}/delete', name: 'pago_delete', methods: ['POST'])]
    public function delete(Request $request, Pago $pago, EntityManagerInterface $em): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete'.$pago->getId(), $request->request->get('_token'))) {
            $em->remove($pago);
            $em->flush();
        }
        return $this->redirectToRoute('pago_index');
    }

    #[Route('/{id}', name: 'pago_show', methods: ['GET'])]
    public function show(Pago $pago): Response
    {
        return $this->render('pago/show.html.twig', [
            'pago' => $pago,
        ]);
    }
} 