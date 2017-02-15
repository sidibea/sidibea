<?php

namespace NB\MainBundle\Form;

use NB\MainBundle\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        // On ajoute une fonction qui va écouter un évènement
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
            function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
                // On récupère notre objet Advert sous-jacent
                $company = $event->getData();

                // Cette condition est importante, on en reparle plus loin
                if (null === $company) {
                    return; // On sort de la fonction sans rien faire lorsque $advert vaut null
                }

                if ($company->getLogo() != null ) {

                    $event->getForm()->add('logo', 'file', array(
                        'required' => false,
                        'mapped' => false,
                    ));
                }

            }
        );

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nb_mainbundle_company_edit';
    }

    public function getParent(){
        return new CompanyType();
    }
}
