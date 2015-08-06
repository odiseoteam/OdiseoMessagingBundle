<?php

namespace Odiseo\Bundle\MessagingBundle\Form\Factory;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormFactoryInterface;

abstract class AbstractMessageFormFactory
{
    protected $formFactory;
    protected $formType;
    protected $formName;
    protected $messageClass;

    public function __construct(FormFactoryInterface $formFactory, AbstractType $formType, $formName, $messageClass)
    {
        $this->formFactory = $formFactory;
        $this->formType = $formType;
        $this->formName = $formName;
        $this->messageClass = $messageClass;
    }

    protected function createModelInstance()
    {
        $class = $this->messageClass;

        return new $class();
    }

    protected  function create()
    {
    	$message = $this->createModelInstance();
    	return $this->formFactory->createNamed($this->formName, $this->formType, $message);
    }
    
    
}
