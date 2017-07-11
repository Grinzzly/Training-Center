<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class LessonsAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('course', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\Course',
                'choice_label' => 'title',
            ))
            ->add('id')
            ->add('title')
            ->add('body')
            ->add('duration')
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
            ->add('course.title')
            ->add('id')
            ->add('title')
            ->add('body')
            ->add('duration')
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
            ->with('select course', array('class' => 'col-md-3'))
            ->add('course', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Course',
                'property' => 'title',
            ))
            ->end()
            ->with('describe lesson plan', array('class' => 'col-md-6'))
            ->add('course', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Course',
                'property' => 'title',
            ))
            ->add('title')
            ->add('body')
            ->add('duration')
            ->end()
            ->with('homeassignment:',['class'=>'col-md-3'])
            ->add('homeassignment', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\HomeAssignment',
                'multiple' => true,
                'property' => 'title',
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
            ->add('body')
            ->add('duration')
            ->add('homeassignment')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
        ;
    }
}
