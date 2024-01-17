<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setEmail('vicepresidencia@cetorremolinos.es')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $user,
                    'admin'
                )
            );
            ;
        $manager->persist($user);

        $manager->flush();
    }
}
