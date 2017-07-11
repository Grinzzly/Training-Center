<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Groups;
use AppBundle\Entity\Users;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->tab('Пользователь')
                ->with('Добавить пользователя', ['class' => 'col-md-7 col-lg-7'])
                    ->add('last_name', 'text', [
                        'label' => 'Фамилия',
                        'required' => true
                    ])
                    ->add('first_name', 'text', [
                        'label' => 'Имя',
                        'required' => true
                    ])
                    ->add('middle_name', 'text', [
                        'label' => 'Отчество',
                        'required' => true
                    ])
                    ->add('phone', 'text', [
                        'label' => 'Телефон',
                        'required' => true
                    ])
                    ->add('email', EmailType::class, [
                        'label' => 'E-Mail']);
        if( $this->request->get('_route') != 'admin_app_users_edit'){
            $form
                ->add('plainPassword', RepeatedType::class, [
                'type' => 'text',
                'options' => ['translation_domain' => 'FOSUserBundle'],
                'first_options' => ['label' => 'form.password'],
                'second_options' => ['label' => 'form.password_confirmation'],
                'invalid_message' => 'fos_user.password.mismatch',
            ]);
        }
            $form
                ->end()
                ->with('Добавить роль', ['class' => 'col-md-5 col-lg-5'])
                    ->add('roles', 'choice', [
                        'label' => 'Роли:',
                        'choices' => [
                            'Слушатель' => 'ROLE_LISTENER',
                            'Родитель' => 'ROLE_PARENT',
                            'Ребенок'   => 'ROLE_CHILD',
                            'Преподаватель' => 'ROLE_TEACHER',
                            'Куратор' => 'ROLE_CURATOR',
                            'Администратор' => 'ROLE_ADMIN'
                        ],
                        'multiple' => true
                    ])
                ->end()
                ->with('Группы', ['class' => 'col-md-5 col-lg-5'])
                    ->add('user_groups', 'sonata_type_model', [
                        'label' => 'Добавить группу',
                        'required' => false,
                        'multiple' => true,
                        'by_reference' => false
                    ])
                ->end()
                ->with('Родители', ['class' => 'col-md-5 col-lg-5'])
                    ->add('parent', 'sonata_type_model', [
                        'label' => 'Добавить родителей',
                        'required' => false
                    ])
                ->end()
            ->end()
            ->tab('Группы')
                ->with('Назначить куратором', ['class' => 'col-md-6 col-lg-6'])
                    ->add('teacherGroup', 'sonata_type_model', [
                        'label' => 'Добавить группу',
                        'multiple' => true,
                        'by_reference' => false,
                        'required' => false
                    ])
                ->end()
                ->with('Назначить преподавателем', ['class' => 'col-md-6 col-lg-6'])
                    ->add('curatorGroup', 'sonata_type_model', [
                        'label' => 'Добавить группу',
                        'multiple' => true,
                        'by_reference' => false,
                        'required' => false
                    ])
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('email', null, [
                'label' => 'E-Mail'
            ])
            ->add('last_name', null, [
                'label' => 'Фамилия'
            ])
            ->add('first_name', null, [
                'label' => 'Имя'
            ])
            ->add('middle_name', null, [
                'label' => 'Отчество'
            ])
            ->add('phone', null, [
                'label' => 'Телефон'
            ])
            ->add('user_groups', null, ['label' => 'Группа'], 'entity', [
                'class' => 'AppBundle\Entity\Groups',
                'choice_label' => 'title'
            ])
            ->add('roles', null, ['label' => 'Роль'], 'choice', [
                'choices' => [
                    'Администратор' => 'ROLE_ADMIN',
                    'Слушатель' => 'ROLE_LISTENER',
                    'Родитель' => 'ROLE_PARENT',
                    'Ребенок'   => 'ROLE_CHILD',
                    'Преподаватель' => 'ROLE_TEACHER',
                    'Куратор' => 'ROLE_CURATOR'
                ]
            ])
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('last_name', null, [
                'label' => 'Фамилия'
            ])
            ->add('first_name', null, [
                'label' => 'Имя'
            ])
            ->add('middle_name', null, [
                'label' => 'Отчество'
            ])
            ->addIdentifier('email', null, [
                'label' => 'E-Mail',
                'route' => [
                    'name' => 'show'
                ]
            ])
            ->add('phone', null, [
                'label' => 'Телефон'
            ])
            ->add('user_groups', null, [
                'label' => 'Группа',
                'associated_property' => 'title',
                'template' => 'SonataAdminBundle:CRUD:user_base_list_group.html.twig',
                'route' => [
                    'name' => 'show'
                ]
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->tab('Профиль')
                ->with('Профиль пользователя')
                    ->add('last_name', null, [
                        'label' => 'Фамилия'
                    ])
                    ->add('first_name', null , [
                        'label' => 'Имя'
                    ])
                    ->add('middle_name', null , [
                        'label' => 'Отчество'
                    ])
                    ->add('phone', null , [
                        'label' => 'Телефон'
                    ])
                    ->add('email', null, [
                        'label' => 'E-mail'
                    ])
                    ->add('createdAt', null, [
                        'label' => 'Дата регистрации',
                        'format' => 'd.m.Y'
                    ])
                ->end()
            ->end()
            ->tab('Группы')
                ->with('Группы')
                    ->add('user_groups')
                ->end()
            ->end()
        ;
        if ( count($this->getSubject()->getParent()) ) {
            $show
                ->tab('Родители')
                    ->with('Родители')
                        ->add('parent', null, [
                            'route' => [
                                'name' => 'show'
                            ]
                        ])
                    ->end()
                ->end()
            ;
        }
        if ( property_exists($this->getSubject(), 'children') ) {
            if (count($this->getSubject()->children)) {
                $show
                    ->tab('Дети')
                    ->with('Дети')
                    ->add('child')
                    ->end()
                    ->end()
                ;
            }
        }
    }
}