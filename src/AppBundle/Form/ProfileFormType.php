<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseProfileFormType;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', null, [
                'label' => 'Фамилия',
                'required' => false
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
            ->remove('current_password')
        ;
    }

    public function getParent()
    {
        return BaseProfileFormType::class;
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}
