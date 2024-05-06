<?php

namespace App\DataFixtures;

use App\Entity\Session;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SessionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $listSessions = [
            [
                'dateDebut' => new \DateTime('2024-05-10 08:00'),
                'dateFin' => new \DateTime('2024-05-10 12:00'),
                'titre' => 'Session 1',
                'description' => 'Description de la session 1',
            ],
            [
                'dateDebut' => new \DateTime('2024-05-15 10:00'),
                'dateFin' => new \DateTime('2024-05-17 16:30'),
                'titre' => 'Session 2',
                'description' => 'Description de la session 2',
            ],
        ];

        foreach ($listSessions as $sessionData) {
            $session = new Session();
            $session->setDateDebut($sessionData['dateDebut']);
            $session->setDateFin($sessionData['dateFin']);
            $session->setTitre($sessionData['titre']);
            $session->setDescription($sessionData['description']);

            $manager->persist($session);
        }

        $manager->flush();
    }
}
