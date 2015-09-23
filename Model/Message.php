<?php

namespace Odiseo\Bundle\MessagingBundle\Model;

use FOS\MessageBundle\Entity\Message as BaseMessage;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Message
 */
class Message extends BaseMessage implements MessageInterface
{
    protected $media;
    protected $mediaFile;

    public function getMedia()
    {
        return $this->media;
    }

    public function setMedia($media)
    {
        $this->media = $media;
        return $this;
    }

    public function getMediaFile()
    {
        return $this->mediaFile;
    }

    public function setMediaFile(File $mediaFile)
    {
        $this->mediaFile = $mediaFile;

        if ($mediaFile)
        {
            $this->createdAt = new \DateTime('now');
        }

        return $this;
    }
}
