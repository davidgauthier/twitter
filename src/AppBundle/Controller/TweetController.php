<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tweet;
use AppBundle\Form\TweetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TweetController extends Controller
{
    /**
     * @Route("/", name="app_tweet_list", methods={"GET"} )
     */
    public function listAction(Request $request)
    {
        $tm = $this->container->get('app.tweetmanager');

        return $this->render(':tweet:list.html.twig', [
                'listTweets' => $tm->getLast(),
            ]
        );
    }

    /**
     * @Route("/tweet/new/", name="app_tweet_new", methods={"GET", "POST"} )
     */
    public function newAction(Request $request)
    {
        $tm = $this->container->get('app.tweetmanager');

        // On crée un objet Tweet
        $tweet = $tm->create();

        // On récup le form
        $formTweet = $this->createForm(TweetType::class, $tweet);

        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $tweet contient les valeurs entrées dans le formulaire
        $formTweet->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        if ($formTweet->isSubmitted() && $formTweet->isValid()) {
            // On enregistre notre objet $tweet dans la base de données
            $tm->save($tweet);

            // Envoie de mail pour notifier un admin
            $this->container->get('app.email_messenger')->sendTweetCreated($tweet);

            // Pour notifier l'utilisateur
            $request->getSession()->getFlashBag()->add('success', $this->get('translator')->trans('tweet.message.succes'));

            // On redirige vers la page de visualisation du tweet nouvellement créé
            return $this->redirectToRoute('app_tweet_view', [
                'id' => $tweet->getId(),
                ]
            );
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render(':tweet:new.html.twig', [
            'formTweet' => $formTweet->createView(),
            ]
        );
    }

    /**
     * @Route("/tweet/{id}", name="app_tweet_view", methods={"GET"} )
     */
    public function viewAction(Request $request, $id)
    {
        $tweetRepository = $this->getDoctrine()->getManager()->getRepository(Tweet::class);

        // On récupère la liste des tweets
        $tweet = $tweetRepository->getTweetById($id);

        if (null === $tweet) {
            throw  $this->createNotFoundException("Le tweet n'existe pas");
        }
        // replace this example code with whatever you need
        return $this->render(':tweet:view.html.twig', [
                'tweet' => $tweet,
            ]
        );
    }






    /**
     * @Route("/favourite-tweet/", name="app_tweet_favourites", methods={"GET"} )
     */
    public function favouritesAction(Request $request)
    {
        $loggedUser= $this->get('security.context')->getToken()->getUser();

        $favouriteRepository = $this->getDoctrine()->getManager()->getRepository(Tweet::class);

        // On récupère la liste des tweets
        $tweet = $tweetRepository->getTweetById($id);

        if (null === $tweet) {
            throw  $this->createNotFoundException("Le tweet n'existe pas");
        }
        // replace this example code with whatever you need
        return $this->render(':tweet:view.html.twig', [
                'tweet' => $tweet,
            ]
        );
    }







}
