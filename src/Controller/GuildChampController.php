<?php

namespace App\Controller;

use App\Entity\GuildChamp;
use App\Form\GuildChampType;
use App\Repository\GuildChampRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guild/champ")
 */
class GuildChampController extends Controller
{
    /**
     * @Route("/", name="guild_champ_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(GuildChamp::class);

        return $this->render('guild_champ/index.html.twig', [
            'guild_champs' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="guild_champ_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $guildChamp = new GuildChamp();
        $form = $this->createForm(GuildChampType::class, $guildChamp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($guildChamp);
            $entityManager->flush();

            return $this->redirectToRoute('guild_champ_index');
        }

        return $this->render('guild_champ/new.html.twig', [
            'guild_champ' => $guildChamp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guild_champ_show", methods={"GET"})
     */
    public function show(GuildChamp $guildChamp): Response
    {
        return $this->render('guild_champ/show.html.twig', [
            'guild_champ' => $guildChamp,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="guild_champ_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GuildChamp $guildChamp): Response
    {
        $form = $this->createForm(GuildChampType::class, $guildChamp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('guild_champ_index', [
                'id' => $guildChamp->getId(),
            ]);
        }

        return $this->render('guild_champ/edit.html.twig', [
            'guild_champ' => $guildChamp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guild_champ_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GuildChamp $guildChamp): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guildChamp->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($guildChamp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('guild_champ_index');
    }
}
