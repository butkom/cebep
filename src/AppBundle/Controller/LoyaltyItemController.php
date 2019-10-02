<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/loyalty/item")
 */
class LoyaltyItemController extends Controller
{
//    /**
//     * @Route("/", name="loyalty_item_index", methods={"GET"})
//     */
//    public function index(LoyaltyItemRepository $loyaltyItemRepository): Response
//    {
//        return $this->render('loyalty_item/index.html.twig', [
//            'loyalty_items' => $loyaltyItemRepository->findAll(),
//        ]);
//    }
//
//    /**
//     * @Route("/new", name="loyalty_item_new", methods={"GET","POST"})
//     */
//    public function new(Request $request): Response
//    {
//        $loyaltyItem = new LoyaltyItem();
//        $form = $this->createForm(LoyaltyItemType::class, $loyaltyItem);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($loyaltyItem);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('loyalty_item_index');
//        }
//
//        return $this->render('loyalty_item/new.html.twig', [
//            'loyalty_item' => $loyaltyItem,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="loyalty_item_show", methods={"GET"})
//     */
//    public function show(LoyaltyItem $loyaltyItem): Response
//    {
//        return $this->render('loyalty_item/show.html.twig', [
//            'loyalty_item' => $loyaltyItem,
//        ]);
//    }
//
//    /**
//     * @Route("/{id}/edit", name="loyalty_item_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, LoyaltyItem $loyaltyItem): Response
//    {
//        $form = $this->createForm(LoyaltyItemType::class, $loyaltyItem);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('loyalty_item_index', [
//                'id' => $loyaltyItem->getId(),
//            ]);
//        }
//
//        return $this->render('loyalty_item/edit.html.twig', [
//            'loyalty_item' => $loyaltyItem,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="loyalty_item_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, LoyaltyItem $loyaltyItem): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$loyaltyItem->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($loyaltyItem);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('loyalty_item_index');
//    }





































    /**
     *
     * @Route("/api/{loyaltyItem}", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the  of an LoyaltyItem",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=\AppBundle\Entity\LoyaltyItem::class, groups={"full"}))
     *     )
     * )
     * @SWG\Tag(name="loyaltyItems")
     */
    public function fetchLoyaltyItemAction()
    {
        // ...
    }
}
