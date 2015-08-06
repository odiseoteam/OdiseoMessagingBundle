<?php

namespace Odiseo\Bundle\MessagingBundle;

use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
use Sylius\Bundle\ResourceBundle\ResourceBundleInterface;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;

class OdiseoMessagingBundle extends AbstractResourceBundle
{
    protected $mappingFormat = ResourceBundleInterface::MAPPING_YAML;

    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM,
        );
    }

    protected function getModelInterfaces()
    {
        return array(
            'Odiseo\Bundle\MessagingBundle\Model\MessageInterface' => 'odiseo_messaging.model.message.class',
            'Odiseo\Bundle\MessagingBundle\Model\MessageMetadataInterface' => 'odiseo_messaging.model.message_metadata.class',
            'Odiseo\Bundle\MessagingBundle\Model\ThreadInterface' => 'odiseo_messaging.model.thread.class',
            'Odiseo\Bundle\MessagingBundle\Model\ThreadMetadataInterface' => 'odiseo_messaging.model.thread_metadata.class',
            'Odiseo\Bundle\MessagingBundle\Model\TopicInterface' => 'odiseo_messaging.model.topic.class',
            'Odiseo\Bundle\MessagingBundle\Model\ParticipantInterface' => 'odiseo_messaging.model.participant.class',
        );
    }

    protected function getModelNamespace()
    {
        return 'Odiseo\Bundle\MessagingBundle\Model';
    }
}