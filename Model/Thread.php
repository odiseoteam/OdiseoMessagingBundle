<?php

namespace Odiseo\Bundle\MessagingBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\Thread as BaseThread;

/**
 * Thread
 */
class Thread extends BaseThread implements ThreadInterface
{
    protected $topic;
	
	public function getTopic()
    {
		return $this->topic;
	}

	public function setTopic(TopicInterface $topic)
    {
		$this->topic = $topic;
		return $this;
	}
}