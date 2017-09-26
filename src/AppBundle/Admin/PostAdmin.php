<?php

namespace AppBundle\Admin;

use function PHPSTORM_META\type;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('content', 'textarea')
            ->add('thumb', 'text')
            ->add('image', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Image',
                'multiple' => true,
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title')
            ->add('thumb')
        ;
    }
}
