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
use AppBundle\Entity\MarqueVoiture;
use AppBundle\Entity\ModeleVoiture;

class VoiturePriceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('marque', EntityType::class, array(
                'class'       => 'AppBundle:MarqueVoiture',
                'required'=> true,
                'placeholder' => '',
            ));

        $formModifier = function (FormInterface $form, MarqueVoiture $marque=null) {
            $modeles = null === $marque ? array() : $marque->getModeles();

            $form->add('modele', EntityType::class, array(
                    'class'       => 'AppBundle:ModeleVoiture',
                    'placeholder' => null === $marque ? 'Please choose a Marque first' : 'Please Choose',
                    'required'=> true,
                    'choices' =>  $modeles,
                    'attr'=> array('class'=> 'form-control mmodele')
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
                    if ($data) {
                        $formModifier($form->getParent(), $data);
                    }
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
