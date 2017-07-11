<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("test")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/show", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();


        $course = new Course();
        $course->setTitle('PHP');
        $course->setDescription('PHP the best');

        $group = new Group();
        $group->setTitle('Hello');
        $group->setCourse($course);

        $group2 = new Group();
        $group2->setTitle('Hello2');
        $group2->setCourse($course);

        $em->persist($course);
        $em->persist($group);
        $em->persist($group2);

        $em->flush();



        return $this->render('base.html.twig');
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $course = $em->getRepository('AppBundle:CourseAdmin')->find(1);

        $em->remove($course);
        $em->flush();

        return $this->render('base.html.twig');
    }

    /**
     * @Route("/list")
     * @return Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        /* Disasble softdeletable filter */
        // $em->getFilters()->disable('softdeleteable');

        $courses = $em
            ->getRepository('AppBundle:CourseAdmin')
            ->findAll()
        ;

        return $this->render('default/courses-list.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'courses' => $courses,
        ]);
        dump($courses);

        return $this->render('base.html.twig');
    }

    /**
     * @Route("/course-create")
     * @return Response
     */
    public function courseAction()
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Course $course */
        $course = new Course();
        $course->setTitle('PHP');
        $course->setDescription('php the best');

        /*$group = $em->getRepository('AppBundle:Group')->find(1);
        $group->setCourse($course);*/


        $newGroup = new Group();
        $newGroup->setTitle('New Group');
        $newGroup->setCourse($course);

        $em->persist($course);
        $em->persist($newGroup);
        $em->flush();

        return $this->render('base.html.twig');
    }

    /**
     * @Route("/user-create")
     */
    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:Users')->find(1);

        /*$group = $em->getRepository('AppBundle:Group')->find(1);

        $user->addGroupId($group);*/

        /*$user = new User();
        $user->setLastName('Last name');
        $user->setMiddleName('Patronymic');
        $user->setPhone('+375291111111');
        $user->setEmail('mail@mail.com');
        $user->setEmailCanonical('mail0@mail.com');
        $user->setPassword('$2y$13$ExRQocJCSl4CMQt0r8I40ub1FgjvmAaBH6X/T9IBE8I5YmKylCuj2');
        $user->setUsername('Name');
        $user->setUsernameCanonical('name');
        $user->setRoles([]);*/

        //$em->persist($user);

        $em->remove($user);
        $em->flush();

        return $this->render('base.html.twig');
    }
}
