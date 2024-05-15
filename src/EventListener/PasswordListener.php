<?php
namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordListener
{

    public function prePersist(Utilisateur $user, LifecycleEventArgs $event)
    {
        $this->hashPassword($user);
    }

    public function preUpdate(Utilisateur $user, LifecycleEventArgs $event)
    {
        $this->hashPassword($user);
    }

    private function hashPassword(Utilisateur $user)
    {
        $plainPassword = $user->getMdp();
        if ($plainPassword) {
            $user->setMdp(password_hash($plainPassword, PASSWORD_DEFAULT));
        }
    }
}
