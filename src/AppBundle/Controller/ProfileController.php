<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Controller\ProfileController as BaseProfileController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProfileController extends BaseProfileController
{
    public function showAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $children = $em->getRepository(Users::class)->findBy(['parent' => $user]);

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('У Вас нет доступа к этому разделу.');
        }

        return $this->render('@FOSUser/Profile/show.html.twig', [
            'user' => $user,
            'children' => $children
        ]);
    }
}