<?php

namespace Odiseo\Bundle\MessagingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MessagingController extends Controller
{
	const ROUTE_MESSAGE_NEW = "odiseo_message_new";
	
	public function listAction(Request $request)
    {
		$threadId = $request->get('threadId');
		$thread = $this->get('odiseo_messaging.service.thread_message')->findThreadById($threadId);

    	$form = $this->get('form.factory')->create('odiseo_messaging_message');

   		return $this->render('OdiseoMessagingBundle:Frontend/Messaging:list.html.twig', array(
            'form' => $form->createView(),
            'thread' => $thread
        ));
    }

	public function listWithCreatorAndTopicAction(Request $request)
	{
		$creatorId = $request->get('creatorId');
		$topicId = $request->get('topicId');
		$thread = $this->get('odiseo_messaging.service.thread_message')->searchThreadByCreatorAndTopic($creatorId, $topicId);

		return $this->redirect($this->generateUrl('odiseo_messaging_list', array('threadId' => $thread->getId())));
	}
	
	public function listMessagesAction(Request $request)
    {
		$threadId = $request->get('threadId');
		$thread = $this->get('odiseo_messaging.service.thread_message')->findThreadById($threadId);

		return $this->render('OdiseoMessagingBundle:Frontend/Messaging/Partial:listMessages.html.twig', array(
			'thread' => $thread
        ));
	}
	
	public function sendMessageAction(Request $request)
    {
		$form = $this->get('form.factory')->create('odiseo_messaging_message');
		$formHandler = $this->get('odiseo_messaging.form.handler.message');

    	if($message = $formHandler->process($form))
        {
            return new JsonResponse(array(
                'error' => false,
                'html' => $this->renderView('OdiseoMessagingBundle:Frontend/Messaging/Partial:messageItem.html.twig', array(
					'message' => $message
                ))
            ));
    	}
	}
}
