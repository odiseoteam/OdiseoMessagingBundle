<?php

namespace Odiseo\Bundle\MessagingBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\ThreadMetadata as BaseThreadMetadata;

/**
 * ThreadMetadata
 */
class ThreadMetadata extends BaseThreadMetadata implements ThreadMetadataInterface
{
}