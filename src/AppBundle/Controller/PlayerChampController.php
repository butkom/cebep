<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlayerChamp;
use AppBundle\Form\PlayerChampType;
use AppBundle\Repository\PlayerChampRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/player/champ")
 */
class PlayerChampController extends Controller
{
    /**
     * @Route("/", name="player_champ_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(PlayerChamp::class);

        return $this->render('player_champ/index.html.twig', [
            'player_champs' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="player_champ_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $playerChamp = new PlayerChamp();
        $form = $this->createForm(PlayerChampType::class, $playerChamp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($playerChamp);
            $entityManager->flush();

            return $this->redirectToRoute('player_champ_index');
        }

        return $this->render('player_champ/new.html.twig', [
            'player_champ' => $playerChamp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_champ_show", methods={"GET"})
     */
    public function show(PlayerChamp $playerChamp): Response
    {
        return $this->render('player_champ/show.html.twig', [
            'player_champ' => $playerChamp,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="player_champ_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlayerChamp $playerChamp): Response
    {
        $form = $this->createForm(PlayerChampType::class, $playerChamp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('player_champ_index', [
                'id' => $playerChamp->getId(),
            ]);
        }

        return $this->render('player_champ/edit.html.twig', [
            'player_champ' => $playerChamp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_champ_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlayerChamp $playerChamp): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playerChamp->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($playerChamp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('player_champ_index');
    }
}
