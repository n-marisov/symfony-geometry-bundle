<?php

namespace Maris\Symfony\Geo\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Maris\Symfony\Geo\Entity\Location;
use ReflectionClass;
use ReflectionException;
use SplObjectStorage;

#[AsEntityListener(event: 'onLoad',method: '__invoke',entity: Location::class)]
class LocationEventListener
{

    protected ReflectionClass $reflection;

    public function __construct()
    {
        $this->reflection = new ReflectionClass(Location::class);
    }

    /**
     * @throws ReflectionException
     */
    public function __invoke(Location $location, PreFlushEventArgs $args ):void
    {
        $this->reflection->getProperty("storage")->setValue($location,new SplObjectStorage());
    }

}