<?php


namespace App\DataFixtures;

use App\Entity\Salle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SalleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $listSalles = [
            [
                'tailleSalle' => 50,
                'nomSalle' => 'Salle A',
                'ville' => 'Paris',
                'adresse' => '1 Rue de Paris',
                'codePostal' => "75004",
            ],
            [
                'tailleSalle' => 30,
                'nomSalle' => 'Salle B',
                'ville' => 'Noisy-Le-Grand',
                'adresse' => '28 Rue de Paul Fort',
                'codePostal' => "93420",
            ],
        ];

        foreach ($listSalles as $salleData) {
            $salle = new Salle();
            $salle->setTailleSalle($salleData['tailleSalle']);
            $salle->setNomSalle($salleData['nomSalle']);
            $salle->setVille($salleData['ville']);
            $salle->setAdresse($salleData['adresse']);
            $salle->setCodePostal($salleData['codePostal']);

            $manager->persist($salle);
        }

        $manager->flush();
    }
}
