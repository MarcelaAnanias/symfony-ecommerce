<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/admin/user', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/admin/user/{id}/to/editor', name: 'app_user_to_editor')]
    public function changeRole(EntityManagerInterface $entityManager, User $user): Response
    {
        $user->setRoles(["ROLE_EDITOR", "ROLE_USER"]);
        $entityManager->flush();

        $this->addFlash(type: 'success', message: 'User successfully modified.');

        return $this->redirectToRoute(route:'app_user');
    }

    #[Route('/admin/user/{id}/remove/editor/role', name: 'app_user_remove_editor_role')]
    public function editorRoleRemove(EntityManagerInterface $entityManager, User $user): Response
    {
        $user->setRoles(["ROLE_USER"]);
        $entityManager->flush();

        $this->addFlash(type: 'danger', message: 'Client role successfully removed.');

        return $this->redirectToRoute(route:'app_user');
    }

    #[Route('/admin/user/{id}/remove', name: 'app_user_remove')]
    public function userRemove(EntityManagerInterface $entityManager, $id, UserRepository $userRepository): Response
    {
        $userFind = $userRepository->find($id);
        $entityManager->remove($userFind);
        $entityManager->flush();

        $this->addFlash(type: 'danger', message: 'User deleted successfully.');

        return $this->redirectToRoute(route:'app_user');
    }
}
