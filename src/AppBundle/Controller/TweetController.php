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
}
