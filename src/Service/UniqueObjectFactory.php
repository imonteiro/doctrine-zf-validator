<?php


namespace Doctrine\Zend\Validator\Service;

use Interop\Container\ContainerInterface;
use Doctrine\Zend\Validator\UniqueObject;

class UniqueObjectFactory extends AbstractValidatorFactory
{
    protected $validatorClass = UniqueObject::class;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $container = $this->container($container);

        $useContext = isset($options['use_context']) ? (boolean) $options['use_context'] : false;

        $validator = new UniqueObject($this->merge($options, [
            'object_manager'    => $this->getObjectManager($container, $options),
            'use_context'       => $useContext,
            'object_repository' => $this->getRepository($container, $options),
            'fields'            => $this->getFields($options),
        ]));

        return $validator;
    }
}
