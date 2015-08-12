<?php

namespace Odiseo\Bundle\MessagingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MessageFormTypeSuscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::POST_SET_DATA => 'onPostSetData',
        );
    }

    public function onPostSetData(FormEvent $event)
    {
    }
    
    
    public function disabledDescription($form)
    {
    }

    public function onPostsSubmit(FormEvent $event)
    {
    }
}