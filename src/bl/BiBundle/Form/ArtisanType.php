<?php

namespace bl\BiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArtisanType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('datenaissance')
            ->add('dateembauche')
            ->add('age')
            //->add('utilisateur') généré automatiquement, et non dans un formulaire
            ->add('corpsMetier')
            ->add('valider', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'bl\BiBundle\Entity\Artisan'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bl_bibundle_artisan';
    }
}
