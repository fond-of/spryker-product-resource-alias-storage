<?php

namespace FondOfSpryker\Client\ProductResourceAliasStorage\Storage;

use Spryker\Client\ProductResourceAliasStorage\Storage\ProductConcreteStorageBySkuReader as SprykerProductConcreteStorageBySkuReader;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Shared\ProductStorage\ProductStorageConstants;

class ProductConcreteStorageBySkuReader extends SprykerProductConcreteStorageBySkuReader implements ProductConcreteStorageReaderInterface
{
    /**
     * @param string $sku
     * @param string $localeName
     *
     * @return array|null
     */
    public function findProductConcreteStorageData(string $sku, string $localeName): ?array
    {
        $synchronizationDataTransfer = new SynchronizationDataTransfer();
        $synchronizationDataTransfer
            ->setReference(static::REFERENCE_NAME . $sku)
            ->setLocale($localeName);

        $key = $this->synchronizationService
            ->getStorageKeyBuilder(ProductStorageConstants::PRODUCT_CONCRETE_RESOURCE_NAME)
            ->generateKey($synchronizationDataTransfer);
        $mappingResource = $this->storageClient->get($key);
        if (!$mappingResource) {
            return null;
        }

        if (!array_key_exists('key', $mappingResource)){
            $mappingResource['key'] = sprintf('%s:%s:%s', ProductStorageConstants::PRODUCT_CONCRETE_RESOURCE_NAME ,strtolower($localeName), $mappingResource['id']);
        }

        return $this->storageClient->get($mappingResource['key']);
    }
}
