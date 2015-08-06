<?php

namespace Odiseo\Bundle\MessagingBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('odiseo_messaging');

        $rootNode
            ->children()
                ->scalarNode('driver')->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM)->end()
            ->end()
        ;

        $this->addClassesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds `classes` section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('message')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Odiseo\Bundle\MessagingBundle\Model\Message')->end()
                                ->scalarNode('repository')->defaultValue('Odiseo\Bundle\MessagingBundle\Doctrine\ORM\MessageRepository')->end()
                            ->end()
                        ->end()
                        ->arrayNode('topic')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->isRequired()->cannotBeEmpty()->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->arrayNode('mapping')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->arrayNode('fields')
                                                    ->prototype('scalar')->end()
                                                    ->defaultValue(array('name', 'slug', 'description', 'meta_keywords', 'meta_description', 'short_description'))
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('participant')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->isRequired()->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                        ->arrayNode('message_metadata')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Odiseo\Bundle\MessagingBundle\Model\MessageMetadata')->end()
                            ->end()
                        ->end()
                        ->arrayNode('thread')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Odiseo\Bundle\MessagingBundle\Model\Thread')->end()
                            ->end()
                        ->end()
                        ->arrayNode('thread_metadata')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Odiseo\Bundle\MessagingBundle\Model\ThreadMetadata')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
