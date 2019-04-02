<?php

namespace Doctrine\Validator\Service;

use PHPUnit\Framework\TestCase;
use Doctrine\Validator\ObjectExists;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Interop\Container\ContainerInterface;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-09-04 at 11:55:36.
 *
 * @coversDefaultClass DoctrineModule\Validator\Service\ObjectExistsFactory
 * @group validator
 */
class ObjectExistsFactoryTest extends TestCase
{
    /**
     * @var ObjectExistsFactory
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ObjectExistsFactory;
    }

    /**
     * @covers ::__invoke
     */
    public function testInvoke()
    {
        $options = [
            'target_class' => 'Foo\Bar',
            'fields'       => ['test'],
        ];

        $repository = $this->prophesize(ObjectRepository::class);
        $objectManager = $this->prophesize(ObjectManager::class);
        $objectManager->getRepository('Foo\Bar')
            ->shouldBeCalled()
            ->willReturn($repository->reveal());

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('doctrine.entitymanager.orm_default')
            ->shouldBeCalled()
            ->willReturn($objectManager->reveal());

        $instance = $this->object->__invoke(
            $container->reveal(),
            ObjectExists::class,
            $options
        );
        $this->assertInstanceOf(ObjectExists::class, $instance);
    }
}
