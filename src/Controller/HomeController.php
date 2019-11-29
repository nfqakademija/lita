<?php

namespace App\Controller;


use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ClientRegistry $clientRegistry)
    {
//        $client = $clientRegistry->getClient('google');
//
//        // OR: get the access token and then user
//        $accessToken = $client->getAccessToken();
//        $user = $client->fetchUserFromToken($accessToken);
//var_dump($user);
//die;



        return $this->render('home/index.html.twig', [
            'title' => 'NFQ Lita',
            'activeNavItem' => 'home'
        ]);




    }
}


