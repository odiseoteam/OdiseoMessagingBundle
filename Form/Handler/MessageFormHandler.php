<?php

namespace Odiseo\Bundle\MessagingBundle\Form\Handler;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;

class MessageFormHandler
{
	protected $request;
	protected $sender;
	protected $composer;
	protected $deliveryService;
	protected $threadService;
    
    public function __construct(ContainerInterface $container)
    {
    	$this->request = $container->get('request');
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

    	$form->submit($this->request);
    	if ($form->isValid())
        {
    		return $this->processValidForm($form);
    	}

    	return false;
    }
    
    public function processValidForm(Form $form)
    {
		$threadId = $this->request->get('threadId');
		$thread = $this->threadService->findThreadById($threadId);

		$message = $this->composer->reply($thread)
			->setSender($this->sender)
			->setBody($form->getData()->getBody())
			->getMessage()
		;
		$mediaFile = $form->get('mediaFile')->getData();
		if($mediaFile)
		{
			$message->setMediaFile($mediaFile);
		}

    	$this->deliveryService->send($message);

    	return $message;
    }
}
