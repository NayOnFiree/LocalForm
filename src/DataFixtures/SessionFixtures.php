<?php

namespace App\DataFixtures;

use App\Entity\Session;
use App\Entity\Salle;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SessionFixtures extends Fixture implements DependentFixtureInterface
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
            [
                'dateDebut' => new \DateTime('2024-02-13'),
                'dateFin' => new \DateTime('2024-02-13'),
                'titre' => 'Session3',
                'description' => 'Description de la session 3',
            ],
        ];

        foreach ($listSessions as $sessionData) {
            $session = new Session();
            $session->setDateDebut($sessionData['dateDebut']);
            $session->setDateFin($sessionData['dateFin']);
            $session->setTitre($sessionData['titre']);
            $session->setDescription($sessionData['description']);
            $session->setSalle($manager->getRepository(Salle::class)->findOneBy(['nomSalle' => "Salle A"]));
            $session->setCreateur($manager->getRepository(Utilisateur::class)->findOneBy(['nni' => "tguehen"]));
            $manager->persist($session);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            SalleFixtures::class,
            UtilisateurFixtures::class,
        );
    }
}
