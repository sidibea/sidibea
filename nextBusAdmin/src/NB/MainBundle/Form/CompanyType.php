<?php

namespace NB\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('adresse', 'textarea' , [
                'required' => false
            ])
            ->add('slogan')
            ->add('description', 'ckeditor')
            ->add('telephone')
            ->add('commission')
            ->add('email')
            ->add('active')
            ->add('metatitre','text')
            ->add('meta_description','textarea', [
                'required' => false
            ])
            ->add('motcle', 'text', [
                'required' => false
            ])
            ->add('logo', 'file', [
                'required' => false
            ])

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NB\MainBundle\Entity\Company'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nb_mainbundle_company';
    }


}
