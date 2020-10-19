<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PingController extends AbstractController
{
    /**
     * @Route("/api/v2/ping", name="ping")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index()
    {
        return $this->json([
            'message' => sprintf('Welcome %s to your new controller!', $this->getUser()->getUsername()),
            'path' => '/symfony/src/Controller/PingController.php',
        ]);
    }
}
