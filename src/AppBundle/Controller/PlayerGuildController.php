<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlayerGuild;
use AppBundle\Form\PlayerGuildType;
use AppBundle\Repository\PlayerGuildRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/player/guild")
 */
class PlayerGuildController extends Controller
{
    /**
     * @Route("/", name="player_guild_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(PlayerGuild::class);

        return $this->render('player_guild/index.html.twig', [
            'player_guilds' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="player_guild_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $playerGuild = new PlayerGuild();
        $form = $this->createForm(PlayerGuildType::class, $playerGuild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($playerGuild);
            $entityManager->flush();

            return $this->redirectToRoute('player_guild_index');
        }

        return $this->render('player_guild/new.html.twig', [
            'player_guild' => $playerGuild,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_guild_show", methods={"GET"})
     */
    public function show(PlayerGuild $playerGuild): Response
    {
        return $this->render('player_guild/show.html.twig', [
            'player_guild' => $playerGuild,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="player_guild_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlayerGuild $playerGuild): Response
    {
        $form = $this->createForm(PlayerGuildType::class, $playerGuild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('player_guild_index', [
                'id' => $playerGuild->getId(),
            ]);
        }

        return $this->render('player_guild/edit.html.twig', [
            'player_guild' => $playerGuild,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_guild_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlayerGuild $playerGuild): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playerGuild->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($playerGuild);
            $entityManager->flush();
        }

        return $this->redirectToRoute('player_guild_index');
    }
}
