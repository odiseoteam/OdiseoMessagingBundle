<?php

namespace Odiseo\Bundle\MessagingBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageFormType extends AbstractResourceType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
            ->add('body', 'textarea', array(
    			'required' => true,
    			'label'    => 'Description'
    	    ))
            ->add('mediaFile', 'file', array(
                'required' => false,
                'label' => 'odiseo.message.attach_file'
            ))
            //->add('ready', 'submit', array('label' => 'READY TO PREORDER'))
            ->add('enviar', 'submit', array('label' => 'odiseo.message.send'))
    	    ->addEventSubscriber(new MessageFormTypeSuscriber())
    	;
    }

    public function getName()
    {
        return 'odiseo_messaging_message';
    }
}
