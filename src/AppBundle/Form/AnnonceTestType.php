<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Form\PhotoType;
use Doctrine\ORM\EntityManager;
use AppBundle\Form\DataTransformer\FilesToPhotosTransformer;

use AppBundle\Form\AdresseType;
use AppBundle\Form\VoitureType;
use AppBundle\Entity\MarqueVoiture;

class AnnonceTestType extends AbstractType
{


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        /*
        ->add('photos', CollectionType::class, array(
            'entry_type' => FileType::class,
            'by_reference' => false,
            'required' => false,
            'allow_add'=>true
        ))*/
        ->add('photos', FileType::class, array(
          'required'=>false,
          'multiple'=>true
        ))
        ->add('save', SubmitType::class, array(
          'label' => 'Krijo annoncen tende'
        ));

        $builder->get('photos')
            ->addModelTransformer(new FilesToPhotosTransformer());
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_annonce';
    }
}
