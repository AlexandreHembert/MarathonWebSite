<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 19/12/2018
 * Time: 11:05
 */

namespace App\Security\Voter;

use App\Entity\Chapitre;
use App\Entity\Histoire;
use App\Entity\User;
use App\Security\AppAccess;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ChapitreVoter extends Voter {
    private $security;

    public function __construct(Security $security) {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [AppAccess::CHAPITRE_NEW, AppAccess::CHAPITRE_EDIT, AppAccess::CHAPITRE_DELETE]))
        {
            return false;
        }

        if (!$subject instanceof Chapitre) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN') === true) {
            return true;
        }

        return $subject->getHistoire()->getUser()->getId() === $user->getId();

    }
}