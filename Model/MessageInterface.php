<?php

namespace Odiseo\Bundle\MessagingBundle\Model;
use Symfony\Component\HttpFoundation\File\File;

/**
 * MessageInterface
 */
interface MessageInterface extends \FOS\MessageBundle\Model\MessageInterface
{
    public function getMedia();
    public function setMedia($media);
    public function getMediaFile();
    public function setMediaFile(File $file);
}