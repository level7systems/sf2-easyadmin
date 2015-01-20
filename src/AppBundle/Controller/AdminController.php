<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;

class AdminController extends EasyAdminController
{

    protected function createEditForm($entity, array $entityFieldsMapping)
    {
        // some extra modifications go here
        $formTypeMap = array (
            'boolean' => 'checkbox',
            'datetime' => 'datetime',
            'datetimetz' => 'datetime',
            'text' => 'textarea' 
        );
        
        $form = $this->createFormBuilder($entity, array (
            'data_class' => $this->entity ['class'] 
        ));
        
        foreach ($entityFieldsMapping as $name => $metadata) {
            if ('association' === $metadata ['type'] && !$metadata ['isOwningSide']) {
                continue;
            }
            
            $formFieldType = array_key_exists($metadata ['type'], $formTypeMap) ? $formTypeMap [$metadata ['type']] : null;
            
            $form->add($name, $formFieldType, array ());
        }
        
        return $form->getForm();
    }
}
