<?php

namespace NB\MainBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('montant')
            ->add('dateExpiration')
            ->add('status', 'choice', array(
                'choices' => array(true => 'active', false => 'Non'),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('libelle')
            ->add('photo','file')
            ->add('axes', 'entity', array(
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
            ->add('description', 'ckeditor', array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    'language' => 'fr'
                    //...
                ),
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NB\MainBundle\Entity\Promotion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nb_mainbundle_promotion';
    }


}
