<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Guild;
use AppBundle\Form\GuildType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guild")
 */
class GuildController extends Controller
{
    /**
     * @Route("/", name="guild_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Guild::class);
        return $this->render('guild/index.html.twig', [
            'guilds' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="guild_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $guild = new Guild();
        $form = $this->createForm(GuildType::class, $guild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($guild);
            $entityManager->flush();

            return $this->redirectToRoute('guild_index');
        }

        return $this->render('guild/new.html.twig', [
            'guild' => $guild,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guild_show", methods={"GET"})
     */
    public function show(Guild $guild): Response
    {
        return $this->render('guild/show.html.twig', [
            'guild' => $guild,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="guild_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Guild $guild): Response
    {
        $form = $this->createForm(GuildType::class, $guild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('guild_index', [
                'id' => $guild->getId(),
            ]);
        }

        return $this->render('guild/edit.html.twig', [
            'guild' => $guild,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guild_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Guild $guild): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guild->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($guild);
            $entityManager->flush();
        }

        return $this->redirectToRoute('guild_index');
    }
}
