<?php

namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\Tweet;
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