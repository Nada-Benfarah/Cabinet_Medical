<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class MyController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function main(): Response
    {
        return $this->render('main.html.twig');
    }

    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        $user = $this->getUser();
        $userEmail = $user->getUserIdentifier();
        $userRole = $user->getRoles();

        return $this->render('profile.html.twig', [
            'user_email' => $userEmail,
            'user_role' => $userRole
        ]);
    }

    #[Route('/admin/img', name: 'admin_img')]
    public function adminImg(): BinaryFileResponse
    {
        $file = new File('../public/img/admin.jpg');

        return $this->file($file, "", ResponseHeaderBag::DISPOSITION_INLINE);
    }

    #[Route('/super-admin/img', name: 'super_admin_img')]
    public function superAdminImg(): BinaryFileResponse
    {
        $file = new File('../public/img/super-admin.jpg');

        return $this->file($file, "", ResponseHeaderBag::DISPOSITION_INLINE);
    }
}