<?php

namespace Odiseo\Bundle\MessagingBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\AbstractResourceExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OdiseoMessagingExtension extends AbstractResourceExtension implements PrependExtensionInterface
{
    protected $applicationName = 'odiseo_messaging';
    protected $configFormat = self::CONFIG_YAML;
    protected $configFiles  = array(
        'services',
        'forms',
        'controllers'
    );

    public function load(array $config, ContainerBuilder $container)
    {
        $this->configure(
            $config,
            new Configuration(),
            $container,
            self::CONFIGURE_LOADER | self::CONFIGURE_DATABASE | self::CONFIGURE_PARAMETERS
        );
    }

    public function prepend(ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));

        $this->prependFOSMessage($container, $config);
    }

    private function prependFOSMessage(ContainerBuilder $container, array $config)
    {
        if (!$container->hasExtension('fos_message')) {
            return;
        }

        $container->prependExtensionConfig('fos_message', array(
            'thread_class'  => $config['classes']['thread']['model'],
            'message_class'  => $config['classes']['message']['model'],
        ));
    }
}
