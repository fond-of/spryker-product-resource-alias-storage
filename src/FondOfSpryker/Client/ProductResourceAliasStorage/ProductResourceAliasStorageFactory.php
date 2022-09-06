<?php

namespace FondOfSpryker\Client\ProductResourceAliasStorage;

use FondOfSpryker\Client\ProductResourceAliasStorage\Storage\ProductConcreteStorageBySkuReader;
use Spryker\Client\ProductResourceAliasStorage\ProductResourceAliasStorageFactory as SprykerProductResourceAliasStorageFactory;

class ProductResourceAliasStorageFactory extends SprykerProductResourceAliasStorageFactory
{
    /**
     * @return \FondOfSpryker\Client\ProductResourceAliasStorage\Storage\ProductConcreteStorageReaderInterface
     */
    public function createProductConcreteStorageBySkuReader()
    {
        return new ProductConcreteStorageBySkuReader(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
        );
    }
}
