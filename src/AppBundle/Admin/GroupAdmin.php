<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Groups;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class GroupAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title')
            ->add('course', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\Course',
                'choice_label' => 'title',
            ))
            ->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('course.id')
            ->add('course.title')
            ->add('id')
            ->add('title')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
//            ->add('id')
            ->with('Group',['class'=>'col-md-7'])
            ->add('course', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Course',
                'property' => 'title',
            ))
            ->add('title')
            ->add('teacher', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Users',
                'property' => 'fullName',
                'label' => 'teacher',
                'required' => false
            ))
            ->add('curator', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Users',
                'property' => 'fullName',
                'label' => 'curator',
                'required' => false
            ))
            ->end()
            ->with('students:',['class'=>'col-md-5'])
            ->add('users', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Users',
                'multiple' => true,
                'property' => 'fullName',
            ))
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('course.title')
            ->add('users')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Groups
            ? '[' . $object->getId() . '] ' . $object->getTitle()
            : 'group'; // shown in the breadcrumb on the create view
    }
}
