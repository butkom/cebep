<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlayerLvl;
use AppBundle\Form\PlayerLvlType;
use AppBundle\Repository\PlayerLvlRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/player/lvl")
 */
class PlayerLvlController extends Controller
{
    /**
     * @Route("/", name="player_lvl_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(PlayerLvl::class);

        return $this->render('player_lvl/index.html.twig', [
            'player_lvls' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="player_lvl_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $playerLvl = new PlayerLvl();
        $form = $this->createForm(PlayerLvlType::class, $playerLvl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($playerLvl);
            $entityManager->flush();

            return $this->redirectToRoute('player_lvl_index');
        }

        return $this->render('player_lvl/new.html.twig', [
            'player_lvl' => $playerLvl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_lvl_show", methods={"GET"})
     */
    public function show(PlayerLvl $playerLvl): Response
    {
        return $this->render('player_lvl/show.html.twig', [
            'player_lvl' => $playerLvl,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="player_lvl_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlayerLvl $playerLvl): Response
    {
        $form = $this->createForm(PlayerLvlType::class, $playerLvl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('player_lvl_index', [
                'id' => $playerLvl->getId(),
            ]);
        }

        return $this->render('player_lvl/edit.html.twig', [
            'player_lvl' => $playerLvl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_lvl_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlayerLvl $playerLvl): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playerLvl->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($playerLvl);
            $entityManager->flush();
        }

        return $this->redirectToRoute('player_lvl_index');
    }
}
