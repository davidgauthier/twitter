<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tweet;
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
        $tweetRepository = $this->getDoctrine()->getManager()->getRepository(Tweet::class);

        // On récupère la liste des tweets
        $listTweets = $tweetRepository->getLastTweets(
            $this->getParameter('app.tweet.nb_last', 10)
        );

        // replace this example code with whatever you need
        return $this->render(':tweet:list.html.twig', [
                'listTweets' => $listTweets,
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

        if(null == $tweet)
            throw  $this->createNotFoundException("Le tweet n'existe pas");

        // replace this example code with whatever you need
        return $this->render(':tweet:view.html.twig', [
                'tweet' => $tweet,
            ]
        );
    }


}
