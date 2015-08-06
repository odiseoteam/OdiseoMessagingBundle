<?php

namespace Odiseo\Bundle\MessagingBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;

/**
 * MessageMetadata
 */
class MessageMetadata extends BaseMessageMetadata implements MessageMetadataInterface
{
}
