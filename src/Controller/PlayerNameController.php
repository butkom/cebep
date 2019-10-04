<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\PlayerName;
use App\Form\PlayerNameType;
use App\Repository\PlayerNameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/player/name")
 */
class PlayerNameController extends Controller
{
    /**
     * @Route("/", name="player_name_index", methods={"GET"})
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(PlayerName::class);

        return $this->render('player_name/index.html.twig', [
            'player_names' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="player_name_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $playerName = new PlayerName();
        $form = $this->createForm(PlayerNameType::class, $playerName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($playerName);
            $entityManager->flush();

            return $this->redirectToRoute('player_name_index');
        }

        return $this->render('player_name/new.html.twig', [
            'player_name' => $playerName,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_name_show", methods={"GET"})
     */
    public function show(PlayerName $playerName): Response
    {
        return $this->render('player_name/show.html.twig', [
            'player_name' => $playerName,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="player_name_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlayerName $playerName): Response
    {
        $form = $this->createForm(PlayerNameType::class, $playerName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('player_name_index', [
                'id' => $playerName->getId(),
            ]);
        }

        return $this->render('player_name/edit.html.twig', [
            'player_name' => $playerName,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="player_name_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlayerName $playerName): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playerName->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($playerName);
            $entityManager->flush();
        }

        return $this->redirectToRoute('player_name_index');
    }
}
