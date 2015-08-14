<?php

namespace Odiseo\Bundle\MessagingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MessagingController extends Controller
// {
// 	const ROUTE_MESSAGE_NEW = "odiseo_message_new";
	
// 	public function listAction($productId, $creatorId = null)
//     {
//     	$form = $this->get('form.factory')->create('odiseo_messaging_message');

//     	if($this->get('odiseo_messaging.form.handler.message')->process($form))
//         {
//     		return $this->redirect( $this->generateUrl('odiseo_product_index'));
//     	}

//     	if($creatorId == null)
//     		$creatorId =  $this->getUser()->getId();

//     	$product = $this->get('odiseo_product.service.product')->findOneById($productId);

//    		return $this->render('OdiseoMessagingBundle:Frontend/Messaging:new.html.twig', array(
//             'form' => $form->createView(),
//             'product' => $product,
//             'creatorId' => $creatorId
//         ));
//     }
	
// 	public function listMessagesAction(Request $request)
//     {
// 		$productId = $request->get('productId');
// 		$creatorId =  $request->get('creatorId');
// 		$thread = $this->get('odiseo_messaging.service.thread_message')->searchThreadByCreatorAndProduct($creatorId, $productId);
// 		$messages = array();

// 		if ($thread != null )
// 		{
// 			$messages = $thread->getMessages();
// 		}

// 		return $this->render('OdiseoMessagingBundle:Frontend/Messaging/Partial:list.html.twig', array(
//             'messages' => $messages,
//             'creatorId' => $creatorId
//         ));
// 	}
	
// 	public function sendMessageAction(Request $request)
//     {
//     	$form = $this->get('form.factory')->create('odiseo_messaging_message');
//     	$creatorId = $request->get('creatorId');
//     	$idProduct = $request->get('id');
//     	$product = $this->get('odiseo_product.service.product')->findOneById($idProduct);

//     	if($this->get('odiseo_messaging.form.handler.message')->process($form))
//         {
//             return new JsonResponse(array(
//                 'error' => false,
//                 'html' => $this->renderView('OdiseoMessagingBundle:Frontend/Messaging/Partial:message_form.html.twig', array(
//                     'product' => $product,
//                     'form' => $form->createView(),
//                     'creatorId' => $creatorId
//                 ))
//             ));
//     	}
// 	}
}
