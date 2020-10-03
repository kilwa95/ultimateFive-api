<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;


use App\Repository\UserRepository;




class SecurityController extends AbstractController
{
    /**
     * @Rest\Post("/login")
     */
    public function login(Request $request,UserRepository $userRepository)
    {
        $body = json_decode($request->getContent(), true);
        $user = $userRepository->findOneBy(['email' => $body["email"]]);

        return $this->json([
            'email' => $user->getEmail(),
            'role' => $user->getRoles(),
        ]);
    }
    
}
