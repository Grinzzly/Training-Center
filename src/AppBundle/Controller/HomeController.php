<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        if ($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->redirectToRoute('fos_user_security_login');
    }
}