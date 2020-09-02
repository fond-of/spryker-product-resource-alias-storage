<?php

namespace FondOfSpryker\Client\ProductResourceAliasStorage;

use FondOfSpryker\Client\ProductResourceAliasStorage\Storage\ProductAbstractStorageBySkuReader;
use FondOfSpryker\Client\ProductResourceAliasStorage\Storage\ProductAbstractStorageReaderInterface;
use FondOfSpryker\Client\ProductResourceAliasStorage\Storage\ProductConcreteStorageBySkuReader;
use Spryker\Client\ProductResourceAliasStorage\ProductResourceAliasStorageFactory as SprykerProductResourceAliasStorageFactory;

class ProductResourceAliasStorageFactory extends SprykerProductResourceAliasStorageFactory
{
    /**
     * @return \FondOfSpryker\Client\ProductResourceAliasStorage\Storage\ProductAbstractStorageReaderInterface
     */
    public function createProductAbstractStorageReader(): ProductAbstractStorageReaderInterface
    {
        return new ProductAbstractStorageBySkuReader(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
            $this->getStore()
        );
    }

    /**
     * @return \FondOfSpryker\Client\ProductResourceAliasStorage\Storage\ProductConcreteStorageReaderInterface
     */
    public function createProductConcreteStorageBySkuReader()
    {
        return new ProductConcreteStorageBySkuReader(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
            $this->getStore()
        );
    }
}
