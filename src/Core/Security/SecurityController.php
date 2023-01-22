<?php

namespace App\Core\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

}