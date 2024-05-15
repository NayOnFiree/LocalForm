<?php

namespace App\Command;

use App\Entity\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'DeleteOldSession',
    description: 'Add a short description for your command',
)]
class DeleteOldSessionCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Supprime les sessions qui ont dépassé un certain délai.')
            ->addArgument('delai', InputArgument::REQUIRED, 'Nombre de jours pour le délai.')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $delai = $input->getArgument('delai');
        $dateLimite = new \DateTime();
        $dateLimite->sub(new \DateInterval('P' . $delai . 'D'));

        $sessionsToDelete = $this->entityManager->createQueryBuilder()
            ->delete(Session::class, 's')
            ->where('s.dateFin < :dateLimite')
            ->setParameter('dateLimite', $dateLimite)
            ->getQuery()
            ->getResult();

        $output->writeln(sprintf('Suppression des sessions terminée.'));

        return Command::SUCCESS;
    }
}
