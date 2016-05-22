<?php

namespace bl\BiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MissionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('nbreArtisans')
            ->add('prixJournalier')
            ->add('dateDebut')
            ->add('dateFin')
            //->add('chantier')
            ->add('corpsMetier'/*, "entity", array(
                'class' => 'blBiBundle:CorpsMetier'
             )*/)
            ->add('valider', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'bl\BiBundle\Entity\Mission'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bl_bibundle_mission';
    }
}
