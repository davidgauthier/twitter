<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tweet;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTweetData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $messages = [
            'Bijour la famille',
            'symfony is cool',
            'Je mange une pomme',
            'Je raconte ma vie sur Facebook, Twitter, Snapchat, et les gens aiment, ces jeunes boloss XD ! Je raconte ma vie sur Facebook, Twitter, Snapchat, et les gens aiment, ces jeunes boloss XD',
            'Timeaaaaa',
            'Tweet 1',
            'Tweet 2',
            'Tweet 3',
            'Tweet 4',
            'Tweet 5',
            'Tweet 6',
        ];
        foreach ($messages as $i => $message) {
            $tweet = new Tweet();
            $tweet->setMessage($message);
            $manager->persist($tweet);
            $this->addReference('tweet-'.$i, $tweet);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}
