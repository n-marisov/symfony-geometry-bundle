<?php

namespace Maris\Symfony\Geo\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Maris\Symfony\Geo\Entity\Location;

#[AsDoctrineListener(event: 'loadClassMetadata')]
class EntityUpdateListener
{
    public function __invoke( LoadClassMetadataEventArgs $args ):void
    {
        $classMetaData = $args->getClassMetadata();

        if($classMetaData->name !== Location::class)
            return;

        dump($classMetaData->fieldMappings);

    }

}