<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use App\Entity\Session;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ParticipantFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {

        $OneSession = $manager->getRepository(Session::class)->findOneBy(['titre' => "Session 1"]);
        $OneUtilisateur = $manager->getRepository(Utilisateur::class)->findOneBy(['nni' => "tguehen"]);

        $participant = new Participant();
        $participant->setSession($OneSession);
        $participant->setUtilisateur($OneUtilisateur);
        $participant->setDateAjout(new \DateTime('2024-05-11'));
        $participant->setRole('Participant');

        $manager->persist($participant);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UtilisateurFixtures::class,
            SessionFixtures::class,
        );
    }
}
