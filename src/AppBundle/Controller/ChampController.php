<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Champ;
use AppBundle\Form\ChampType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/champ")
 */
class ChampController extends Controller
{
    /**
     * @Route("/", name="champ_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Champ::class);

        return $this->render('champ/index.html.twig', [
            'champs' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="champ_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $champ = new Champ();
        $form = $this->createForm(ChampType::class, $champ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($champ);
            $entityManager->flush();

            return $this->redirectToRoute('champ_index');
        }

        return $this->render('champ/new.html.twig', [
            'champ' => $champ,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="champ_show", methods={"GET"})
     */
    public function show(Champ $champ): Response
    {
        return $this->render('champ/show.html.twig', [
            'champ' => $champ,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="champ_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Champ $champ): Response
    {
        $form = $this->createForm(ChampType::class, $champ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('champ_index', [
                'id' => $champ->getId(),
            ]);
        }

        return $this->render('champ/edit.html.twig', [
            'champ' => $champ,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="champ_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Champ $champ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$champ->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($champ);
            $entityManager->flush();
        }

        return $this->redirectToRoute('champ_index');
    }
}
