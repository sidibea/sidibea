<?php

namespace NB\MainBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('boardingTime', 'time', array(
            ))
            ->add('arrivalTime', 'time', array(
            ))
            ->add('description', 'ckeditor')
            ->add('price')
            ->add('active', 'choice', array(
                'choices' => array(true => 'Oui', false => 'Non'),
                'expanded' => true,
                'multiple' => false
            ))

            ->add('route', 'entity', array(
                'class'    => 'NBMainBundle:Route',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('r')
                        ->where('r.active = :active')
                        ->setParameter('active', true)
                        ->orderBy('r.title', 'ASC');
                },
                'property' => 'title',
                'multiple' => false,
            ))
            ->add('bus', 'entity', array(
                'class'    => 'NBMainBundle:Bus',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('b')
                        ->where('b.active = :active')
                        ->setParameter('active', true)
                        ->orderBy('b.regno', 'ASC');
                },
                'property' => 'uniqueName',
                'multiple' => false,
            ))
            ->add('frequency', 'entity', array(
                'class'    => 'NBMainBundle:Frequency',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->orderBy('f.value', 'ASC');
                },
                'property' => 'nom',
                'multiple' => true,
            ))
            ->add('price')
            ->add('pickupAddress')
            ->add('dropAddress')

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NB\MainBundle\Entity\Travel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nb_mainbundle_travel';
    }


}
