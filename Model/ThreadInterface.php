<?php

namespace Odiseo\Bundle\MessagingBundle\Model;

/**
 * ThreadInterface
 */
interface ThreadInterface
{
    public function getTopic();
    public function setTopic(TopicInterface $topic);
}