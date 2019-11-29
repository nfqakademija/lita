<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GoogleController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     * @param ClientRegistry $clientRegistry
     *
     * @Route("/connect/google", name="connect_google_start")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectAction(ClientRegistry $clientRegistry)
    {
        return $clientRegistry
            ->getClient('google')
            ->redirect([
                'profile', 'email' // the scopes you want to access
            ])
            ;
    }

    /**
     * After going to Google, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     *
     * @param Request $request
     * @param ClientRegistry $clientRegistry
     *
     * @Route("/connect/google/check", name="connect_google_check")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
    {
        return $this->redirectToRoute('home');
    }
}




//namespace App\Controller;
//
//use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
//use KnpU\OAuth2ClientBundle\Client\Provider\GoogleClient;
//use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
//use League\OAuth2\Client\Provider\GoogleUser;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Routing\Annotation\Route;
//
//class GoogleController extends AbstractController
//{
//    /**
//     * Link to this controller to start the "connect" process
//     *
//     * @Route("/connect/google", name="connect_google_start")
//     * @param ClientRegistry $clientRegistry
//     * @return RedirectResponse
//     */
//    public function connectAction(ClientRegistry $clientRegistry)
//    {
//        // on Symfony 3.3 or lower, $clientRegistry = $this->get('knpu.oauth2.registry');
//
//        // will redirect to Google!
//        return $clientRegistry
//            ->getClient('google') // key used in config/packages/knpu_oauth2_client.yaml
//            ->redirect([
//                'profile', 'email' // the scopes you want to access
//            ])
//            ;
//    }
//
//    /**
//     * After going to Google, you're redirected back here
//     * because this is the "redirect_route" you configured
//     * in config/packages/knpu_oauth2_client.yaml
//     *
//     * @Route("/connect/google/check", name="connect_google_check")
//     * @param Request $request
//     * @param ClientRegistry $clientRegistry
//     */
//    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
//    {
//        // ** if you want to *authenticate* the user, then
//        // leave this method blank and create a Guard authenticator
//        // (read below)
//
//        /** @var GoogleClient $client */
//        $client = $clientRegistry->getClient('google');
//
//        try {
//            // the exact class depends on which provider you're using
//            /** @var GoogleUser $user */
//            $user = $client->fetchUser();
//
//            // do something with all this new power!
//            // e.g. $name = $user->getFirstName();
//            var_dump($user);
//            die;
//            // ...
//        } catch (IdentityProviderException $e) {
//            // something went wrong!
//            // probably you should return the reason to the user
//            var_dump($e->getMessage());
//            die;
//        }
//    }
//}











//
//
//
//namespace App\Controller;
//
//use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
//use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Routing\Annotation\Route;
//
//class GoogleController extends AbstractController
//{
//    /**
//     * Link to this controller to start the "connect" process
//     * @param ClientRegistry $clientRegistry
//     *
//     * @Route("/connect/google", name="connect_google_start")
//     *
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function connectAction(ClientRegistry $clientRegistry)
//    {
//        return $clientRegistry
//            ->getClient('google')
//            ->redirect([
//                'profile', 'email' // the scopes you want to access
//            ])
//            ;
//    }
//
//    /**
//     * After going to Google, you're redirected back here
//     * because this is the "redirect_route" you configured
//     * in config/packages/knpu_oauth2_client.yaml
//     *
//     * @param Request $request
//     * @param ClientRegistry $clientRegistry
//     *
//     * @Route("/connect/google/check", name="connect_google_check")
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
//    {
//
//        // ** if you want to *authenticate* the user, then
//        // leave this method blank and create a Guard authenticator
//        // (read below)
//
//        /** @var \KnpU\OAuth2ClientBundle\Client\Provider\FacebookClient $client */
//        $client = $clientRegistry->getClient('google');
//
//        try {
//            // the exact class depends on which provider you're using
//            /** @var \League\OAuth2\Client\Provider\FacebookUser $user */
//            $user = $client->fetchUser();
//
//            // do something with all this new power!
//            // e.g. $name = $user->getFirstName();
//            var_dump($user); die;
//            // ...
//        } catch (IdentityProviderException $e) {
//            // something went wrong!
//            // probably you should return the reason to the user
//            var_dump($e->getMessage()); die;
//        }
//
//
//        return $this->redirectToRoute('home');
//    }
//}