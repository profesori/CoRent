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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use AppBundle\Form\PhotoType;
use Doctrine\ORM\EntityManager;
use AppBundle\Form\DataTransformer\FilesToPhotosTransformer;

use AppBundle\Form\AdresseType;
use AppBundle\Form\VoitureType;
use AppBundle\Entity\MarqueVoiture;

class DemandeFormType extends AbstractType
{


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('emri', TextType::class,
          array('constraints' => array(
                   new NotBlank(),
                   new Length(array('min' => 3)),
               )))
         ->add('mbiemri', TextType::class,
         array('constraints' => array(
                  new NotBlank(),
                  new Length(array('min' => 3)),
              )))
          ->add('email', EmailType::class,
          array('constraints' => array(
                   new NotBlank(),
                   new Length(array('min' => 3)),
               )))
           ->add('telefon', NumberType::class,
           array('constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 10,'max'=>10)),
                )))
          ->add('dateDebut', DateType::class, array(
            'html5'=>false,
            'widget' => 'single_text',
          ))
          ->add('dateFin', DateType::class, array(
            'html5'=>false,
            'widget' => 'single_text',
          ));
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_demmande';
    }
}
