<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $listUsers = [
            [
                'nni' => 'tguehen',
                'mdp' => 'motdepasse1',
                'nom' => 'Guehennneux',
                'prenom' => 'Theo',
                'email' => 'tguehen@gmail.com',
                'numTelephone' => '0789570923',
                'lstRoles' => ['ADMIN'],
                'isActive' => true,
            ],
            [
                'nni' => 'amori',
                'mdp' => 'motdepasse2',
                'nom' => 'Mori',
                'prenom' => 'Alice',
                'email' => 'amori@gmail.com',
                'numTelephone' => '0618837890',
                'lstRoles' => [],
                'isActive' => true,
            ],
            [
                'nni' => 'jdoe',
                'mdp' => 'password3',
                'nom' => 'Doe',
                'prenom' => 'John',
                'email' => 'jdoe@gmail.com',
                'numTelephone' => '0789570923',
                'lstRoles' => [],
                'isActive' => true,
            ],
            [
                'nni' => 'wlaflor',
                'mdp' => '2motdepasse',
                'nom' => 'Laflor',
                'prenom' => 'Warren',
                'email' => 'wlaflor@gmail.com',
                'numTelephone' => '0756569219',
                'lstRoles' => [],
                'isActive' => false,
            ],
            [
                'nni' => 'tletourneur',
                'mdp' => 'password4',
                'nom' => 'Letourneur',
                'prenom' => 'Theo',
                'email' => 'tletourneur@gmail.com',
                'numTelephone' => '0689342415',
                'lstRoles' => [],
                'isActive' => true,
            ],
        ];

        foreach ($listUsers as $userData) {
            $user = new Utilisateur();
            $user->setNni($userData['nni']);
            $user->setMdp(password_hash($userData['mdp'], PASSWORD_DEFAULT));
            $user->setNom($userData['nom']);
            $user->setPrenom($userData['prenom']);
            $user->setEmail($userData['email']);
            $user->setNumTelephone($userData['numTelephone']);
            $user->setLstRoles($userData['lstRoles']);
            $user->setActive($userData['isActive']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
