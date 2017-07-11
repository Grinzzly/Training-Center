<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', null, [
                'label' => 'Фамилия',
                'required' => true
            ])
            ->add('first_name', null, [
                'label' => 'Имя',
                'required' => true
            ])
            ->add('middle_name', null, [
                'label' => 'Отчество',
                'required' => true
            ])
            ->add('phone', null, [
                'label' => 'Телефон',
                'required' => true
            ])
            ->remove('username')
        ;
    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
