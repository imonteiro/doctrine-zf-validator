<?php

declare(strict_types=1);

namespace Doctrine\Zend\Validator;

/**
 * Config provider for DoctrineORMModule config
 *
 * @license MIT
 * @link    www.doctrine-project.org
 * @author  James Titcumb <james@asgrim.com>
 */
class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke()
    {
        return [
            'validators' => $this->getValidatorConfig(),
        ];
    }

    /**
     * @return array
     */
    public function getValidatorConfig()
    {
        return [
            'aliases'   => [
                'DoctrineNoObjectExists' => NoObjectExists::class,
                'DoctrineObjectExists'   => ObjectExists::class,
                'DoctrineUniqueObject'   => UniqueObject::class,
            ],
            'factories' => [
                NoObjectExists::class => Service\NoObjectExistsFactory::class,
                ObjectExists::class   => Service\ObjectExistsFactory::class,
                UniqueObject::class   => Service\UniqueObjectFactory::class,
            ],
        ];
    }
}
