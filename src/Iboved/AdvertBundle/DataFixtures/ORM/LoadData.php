<?php

namespace Iboved\AdvertBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Iboved\AdvertBundle\Entity\Rubric;
use Iboved\AdvertBundle\Entity\User;
use Iboved\AdvertBundle\Entity\Advert;

class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $rubric = new Rubric();
        $rubric->setName('Auto');

        $user = new User();
        $user->setName("Pavel");
        $user->setCity("Cherkasy");
        $user->setEmail("durov@gmail.com");
        $user->setPhone("+380968763535");

        $advert = new Advert();
        $advert->setTitle("BMW X6");
        $advert->setDescription("Coming with a more robust design and outstanding performance, the 2015 BMW X6 strengthens its position as a leading exponent of exclusive driving pleasure in the segment. The new X6 is longer and lower than the last-generation X5 on which it is based, seating only four.");
        $advert->setCreatedAt(new \DateTime());
        $advert->setRubric($rubric);
        $advert->setUser($user);

        $manager->persist($rubric);
        $manager->persist($user);
        $manager->persist($advert);

        $rubric = new Rubric();
        $rubric->setName('Electronics');

        $user = new User();
        $user->setName("Mark");
        $user->setCity("Kyiv");
        $user->setEmail("zuckerberg@gmail.com");
        $user->setPhone("+380638742727");

        $advert = new Advert();
        $advert->setTitle("MacBookAir 11");
        $advert->setDescription("MacBook Air is a thin, lightweight laptop from Apple.  Because it is a full-sized notebook but only weighs three pounds, the laptop falls into a category that vendors are currently calling ultraportable.");
        $advert->setCreatedAt(new \DateTime());
        $advert->setRubric($rubric);
        $advert->setUser($user);

        $manager->persist($rubric);
        $manager->persist($user);
        $manager->persist($advert);

        $manager->flush();
    }
}
