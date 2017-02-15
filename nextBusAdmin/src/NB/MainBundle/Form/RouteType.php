<?php

namespace NB\MainBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('source', 'entity', array(
                'class'    => 'NBMainBundle:City',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('v')
                        ->where('v.active = :active')
                        ->setParameter('active', true)
                        ->orderBy('v.nom', 'ASC');
                },
                'property' => 'nom',
                'multiple' => false,
            ))
            ->add('destination', 'entity', array(
                'class'    => 'NBMainBundle:City',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('v')
                        ->where('v.active = :active')
                        ->setParameter('active', true)
                        ->orderBy('v.nom', 'ASC');
                },
                'property' => 'nom',
                'multiple' => false,
            ))
            ->add('type', 'choice', array(
                'choices' => array(true => 'Nationale', false => 'Internationale'),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('description', 'ckeditor', array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    'language' => 'fr'
                    //...
                ),
            ))
            ->add('distance')
            ->add('photo', 'file')
            ->add('active', 'choice', array(
                'choices' => array(true => 'Oui', false => 'Non'),
                'expanded' => true,
                'multiple' => false
            ))        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NB\MainBundle\Entity\Route'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nb_mainbundle_route';
    }


}
