<?php

namespace App\DataFixtures;

use App\Constant\StatusConstant;
use App\Entity\ApiKey;
use App\Entity\InvestFolder;
use App\Entity\ProfilPicture;
use App\Entity\Procuration;
use App\Entity\User;
use App\Service\Api\GeoGouv\CallGeoApi;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    const DEFAULT_OWNER_USER = [
        'email' => "owner@testwikicamper.com",
        'password' => "owner",
        'role'=> "ROLE_OWNER"
    ];
    const DEFAULT_TENANT_USER = [
        'email' => "tenant@testwikicamper.com",
        'password' => 'tenant',
        'role'=> "ROLE_TENANT"
    ];
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        /**
         * Fixture owner
         */
        $owner = new User();
        $passwordHash = $this->encoder->hashPassword($owner, self::DEFAULT_OWNER_USER['password']);
        //birthday
        $owner->setEmail(self::DEFAULT_OWNER_USER['email'])
            ->setPassword($passwordHash)
            ->setRoles([self::DEFAULT_OWNER_USER['role']])
        ;
        $manager->persist($owner);

        /**
         * fixture tenant
         */
        $tenant = new User();
        $passwordHash = $this->encoder->hashPassword($tenant, self::DEFAULT_TENANT_USER['password']);
        //birthday
        $tenant->setEmail(self::DEFAULT_TENANT_USER['email'])
            ->setPassword($passwordHash)
            ->setRoles([self::DEFAULT_TENANT_USER['role']])
        ;
        $manager->persist($tenant);


        $manager->flush();
    }

}
