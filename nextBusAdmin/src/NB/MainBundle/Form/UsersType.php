<?php

namespace NB\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text', [
                'attr' => array('class'=>'form-control'),
                'label' => 'Nom'
            ])
            ->add('lastname', 'text', [
                'attr' => array('class'=>'form-control'),
                'label' => 'Prenom'
            ])
            ->add('email', 'email', array(
                'label' => 'Adresse Email',
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('class'=>'form-control')
            ))
            ->add('username', null, array(
                'label' => 'Nom d\'utilisateur',
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('class'=>'form-control')
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'Mot de passe', 'attr'=>array('class'=>'form-control')),
                'second_options' => array('label' => 'Retapez le mot de passe', 'attr'=>array('class'=>'form-control')),
                'invalid_message' => 'fos_user.password.mismatch',

            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NB\UsersBundle\Entity\Users'
        ));
    }
}
