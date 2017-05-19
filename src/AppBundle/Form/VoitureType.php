<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Repository\ModeleVoitureRepository;


use AppBundle\Repository\DicoRepository;
use AppBundle\Entity\MarqueVoiture;
use AppBundle\Entity\ModeleVoiture;

class VoitureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $portes = 'PORTES';
        $places = 'PLACES';
        $carburant = 'CARBURANT';
        $boite = 'BOITE';
        $options = 'OPTIONES';


        $builder
        ->add('marque', EntityType::class, array(
                'class'       => 'AppBundle:MarqueVoiture',
                'placeholder' => '',
            ))
        ->add('anneeProduction', TextType::class)
        ->add('portes', EntityType::class, array(
                'class'       => 'AppBundle:Dico',
                'placeholder' => 'Portes',
                'query_builder' => function (DicoRepository $repository) use ($portes) {
                    return $repository->getDicoByDicotype($portes);
                }
            ))
        ->add('places', EntityType::class, array(
                'class'       => 'AppBundle:Dico',
                'placeholder' => 'Places',
                'query_builder' => function (DicoRepository $repository) use ($places) {
                    return $repository->getDicoByDicotype($places);
                }
            ))
        ->add('carburant', EntityType::class, array(
                'class'       => 'AppBundle:Dico',
                'placeholder' => 'Carburant',
                'query_builder' => function (DicoRepository $repository) use ($carburant) {
                    return $repository->getDicoByDicotype($carburant);
                }
            ))
        ->add('boite', EntityType::class, array(
                'class'       => 'AppBundle:Dico',
                'placeholder' => 'Boite',
                'query_builder' => function (DicoRepository $repository) use ($boite) {
                    return $repository->getDicoByDicotype($boite);
                }
            ))
        ->add('kmParcourues', TextType::class)
        ->add('Options', EntityType::class, array(
                'class'       => 'AppBundle:Dico',
                'placeholder' => 'Options',
                'query_builder' => function (DicoRepository $repository) use ($boite) {
                    return $repository->getDicoByDicotype($boite);
                },
                'multiple'     => true,
                'expanded'     => true,
            ));

        $formModifier = function (FormInterface $form, MarqueVoiture $marque=null) {
            $modeles = null === $marque ? array() : $marque->getModeles();

            $form->add('modele', EntityType::class, array(
                    'class'       => 'AppBundle:ModeleVoiture',
                    'placeholder' => null === $marque ? 'Please choose a Marque first' : 'Please Choose',
                    'choices' =>  $modeles
                  ));
        };

        $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) use ($formModifier) {
                    $data = $event->getData();
                    $id = $data->getMarque()===null ? null : $data->getMarque();
                    $formModifier($event->getForm(), $id);
                }
            );

        $builder->get('marque')->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) use ($formModifier) {
                    $form = $event->getForm();
                    $data = $event->getForm()->getData();
                    echo "<script>console.log( 'Debug Objects: " . $event->getData() . "' );</script>";

                    $formModifier($form->getParent(), $data);
                }
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Voiture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_voiture';
    }
}
