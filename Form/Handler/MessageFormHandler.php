<?php

namespace Odiseo\Bundle\MessagingBundle\Form\Handler;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;

class MessageFormHandler
{
	protected $serviceContainer;
	protected $request;
	protected $productService;
	protected $sender;
	protected $composer;
	protected $deliveryService;
	protected $threadService;
    
    public function __construct(ContainerInterface $container)
    {
    	$this->container = $container;
    	$this->request = $container->get('request');
    	$this->productService = $container->get('odiseo_product.service.product');
    	$this->threadService =  $container->get('odiseo_messaging.service.thread_message');
    	$this->deliveryService = $container->get('fos_message.sender');
    	$this->composer = $container->get('fos_message.composer');
    	$this->sender = $container->get('security.context')->getToken()->getUser();
    }
    
    public function process(Form $form)
    {
    	if ('POST' !== $this->request->getMethod())
        {
    		return false;
    	}

    	$form->bind($this->request);
    	if ($form->isValid())
        {
    		return $this->processValidForm($form);
    	}

    	return false;
    }
    
    public function processValidForm(Form $form)
    {
    	$productId = $this->request->get('id');
    	$creatorId = $this->request->get('creatorId');
    	$product = $this->productService->findOneById($productId);
    	$recipient = $product->getVendor();
    	
    	$thread = $this->threadService->searchThreadByCreatorAndProduct($creatorId , $productId);
    	
    	$message = null ;
    	if( $thread == null)
    	{
    		$message = $this->composer->newThread()
    		->setSender($this->sender)
    		->addRecipient($recipient)
    		->setSubject('Consulting for Media')
    		->setBody($form->getData()->getBody())
    		->getMessage();
    		$message->getThread()->setTopic($product);
    		
    	}else {
    		$message = $this->composer->reply($thread)
    		->setSender($this->sender)
    		->setBody($form->getData()->getBody())
    		->getMessage();
    	}
    	$this->deliveryService->send($message);
    	return true;
    }
}
