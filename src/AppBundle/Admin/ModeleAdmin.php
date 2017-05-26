<?php
// src/AppBundle/Admin/ModeleAdmin.php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class ModeleAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('modele', 'text', array(
                'label' => 'Libelle du Modele'
            ))
            ->add('marque', 'entity', array(
                'class' => 'AppBundle\Entity\MarqueVoiture'
            ))
            ->add('categorie', 'entity', array(
                'class' => 'AppBundle\Entity\PriceCategorie'
            ));
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('marque')
            ->add('categorie')
       ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('modele')
            ->addIdentifier('marque')
            ->addIdentifier('categorie')
       ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
        ->add('modele')
        ->add('marque')
        ->add('categorie')
       ;
    }
}
