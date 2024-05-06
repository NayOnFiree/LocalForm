<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use App\Entity\Session;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ParticipantFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {



        $utilisateur = new Utilisateur();
        $utilisateur->setNni('fdoe');
        $utilisateur->setMdp(password_hash('password4', PASSWORD_DEFAULT)); 
        $utilisateur->setNom('Doe');
        $utilisateur->setPrenom('Florian');
        $utilisateur->setEmail('fdoe@gmail.com');
        $utilisateur->setNumTelephone('0789570989');
        $utilisateur->setLstRoles([]);
        $utilisateur->setActive(true);

        $manager->persist($utilisateur);
        $manager->flush();

        $session = new Session();
        $session->setDateDebut(new \DateTime('2024-05-12 14:00'));
        $session->setDateFin(new \DateTime('2024-05-13 12:00'));
        $session->setTitre('Session 3');
        $session->setDescription('Description de la session 3');

        $manager->persist($session);
        $manager->flush();
    

        $participant = new Participant();
        $participant->setSession($session);
        $participant->setUtilisateur($utilisateur);
        $participant->setDateAjout(new \DateTime('2024-05-11'));
        $participant->setRole('Participant');

        $manager->persist($participant);
        $manager->flush();
    }
}
