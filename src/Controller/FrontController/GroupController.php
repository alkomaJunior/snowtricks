<?php

namespace App\Controller\FrontController;

use App\Entity\Group;
use App\Form\GroupType;
use App\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/group")
 */
class GroupController extends AbstractController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @Route("/", name="group_index", methods={"GET"})
     */
    public function index(GroupRepository $groupRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        return $this->render('front/group/index.html.twig', [
            'groups' => $groupRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="group_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $group = new Group();
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $group->setSlug(strtolower(preg_replace('/\s+/', '', $group->getTitle())));
            $entityManager->persist($group);
            $entityManager->flush();

            $this->addFlash("success", $this->translator->trans("Group successfully created"));
            return $this->redirectToRoute('group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/group/new.html.twig', [
            'group' => $group,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="group_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Group $group, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", $this->translator->trans("Group successfully edited"));
            return $this->redirectToRoute('group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/group/edit.html.twig', [
            'group' => $group,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="group_delete", methods={"POST"})
     */
    public function delete(Request $request, Group $group, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $csrfId = sprintf("delete%s", $group->getSlug());

        if ($this->isCsrfTokenValid($csrfId, $request->request->get('_token'))) {
            $entityManager->remove($group);
            $entityManager->flush();
        }

        $this->addFlash("success", $this->translator->trans("Group successfully deleted"));
        return $this->redirectToRoute('group_index', [], Response::HTTP_SEE_OTHER);
    }
}
