<?php

namespace Odiseo\Bundle\MessagingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Odiseo\Bundle\MessagingBundle\Form\Factory\SingleMessageFormFactory;
use Odiseo\Bundle\MessagingBundle\Form\Handler\SingleMessageFormHandler;

class MessagingController extends BaseController
{
	const ROUTE_MESSAGE_NEW = "odiseo_message_new";
	
	private $formFactory;
	private $formHandler;
	private $productService;
	private $threadService;

	public function __construct( $tokenStorage, $router , $templating , SingleMessageFormFactory $formFactory, SingleMessageFormHandler $formHandler, $productService, $threadService){
		
		parent::__construct($tokenStorage, $router, $templating );
		$this->formFactory =  $formFactory;
		$this->formHanlder = $formHandler;
		$this->productService = $productService;
		$this->threadService = $threadService;
	}
	
	public function listAction($productId, $creatorId = null)
    {
    	$form = $this->formFactory->create();
    	if($this->formHanlder->process($form)){
    		return $this->redirect( $this->generateUrl('odiseo_product_index'));
    	}
    	if($creatorId == null )
    		$creatorId =  $this->getUser()->getId();
    	$product = $this->productService->findOneById($productId);
   		return $this->render('OdiseoEcommerceBundle:Frontend/Messaging:new.html.twig', array('id' => '', 'form' => $form->createView(), 'product'  => $product , 'creatorId' => $creatorId));
    }
	
	public function listMessagesAction(Request $request)
    {
		$productId = $request->get('productId');
		$creatorId =  $request->get('creatorId');
		$thread = $this->threadService->searchThreadByCreatorAndProduct($creatorId , $productId);
		$messages = array();
		if ($thread != null )
		{
			$messages = $thread->getMessages();
		}
		return $this->render('OdiseoEcommerceBundle:Frontend/Messaging/Partial:list.html.twig', array('messages'  => $messages , 'creatorId' => $creatorId));
	}
	
	public function sendMessageAction(Request $request)
    {
    	$form = $this->formFactory->create();
    	$creatorId = $request->get('creatorId');
    	$idProduct = $request->get('id');
    	$product = $this->productService->findOneById($idProduct);
    	if($this->formHanlder->process($form)){
          return new JsonResponse(
    			array(
    			 	 	'error' => false, 
    					'html' => $this->renderView('OdiseoEcommerceBundle:Frontend/Messaging/Partial:message_form.html.twig', array('product' => $product , 'form' => $form->createView() , 'creatorId' => $creatorId )))
          			);
    	}
	}
}
