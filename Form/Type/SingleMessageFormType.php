<?php

namespace Odiseo\Bundle\MessagingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SingleMessageFormType extends AbstractType
{
	private $router;	
	
	public function __construct($router)
    {
		$this->router = $router;
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
            ->add('body', 'textarea', array(
    			'required' => true,
    			'label'    => 'Description'
    	    ))
            ->add('ready', 'submit', array('label' => 'READY TO PREORDER'))
            ->add('enviar', 'submit', array('label' => 'Enviar'))
    	    ->addEventSubscriber(new MessageFormTypeSuscriber())
    	;
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
            'cascade_validation' => true,
		));
	}

    public function getName()
    {
        return 'odiseo_ecommerce_single_message';
    }
}
