<?php


namespace AppBundle\Manager;


use AppBundle\Entity\Tweet;
use Doctrine\ORM\EntityManagerInterface;


class TweetManager
{


    private $em;
    private $nbLast;


    /**
     * TweetManager constructor.
     * @param EntityManagerInterface $em
     * @param $nbLast
     */
    public function __construct(EntityManagerInterface $em, $nbLast)
    {
        $this->em       = $em;
        $this->nbLast  = (int) $nbLast;
    }

    /**
     * @return Tweet
     */
    public function create(){
        return new Tweet();
    }


    /**
     * @param Tweet $tweet
     */
    public function save(Tweet $tweet){

        $this->em->persist($tweet);
        $this->em->flush();

    }


    /**
     * @return array de Tweet
     */
    public function getLast(){

        $tweetRepository = $this->em->getRepository(Tweet::class);

        // On récupère la liste des tweets
        $listTweets = $tweetRepository->getLastTweets($this->nbLast);

        return $listTweets;

    }

}