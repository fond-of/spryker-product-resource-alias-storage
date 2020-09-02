<?php

namespace FondOfSpryker\Client\ProductResourceAliasStorage\Storage;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Client\ProductResourceAliasStorage\Storage\ProductAbstractStorageBySkuReader as SprykerProductAbstractStorageBySkuReader;
use Spryker\Shared\ProductStorage\ProductStorageConstants;

class ProductAbstractStorageBySkuReader extends SprykerProductAbstractStorageBySkuReader implements ProductAbstractStorageReaderInterface
{
    /**
     * @param string $identifier
     * @param string $localeName
     *
     * @return array|null
     */
    public function findProductAbstractStorageData(string $identifier, string $localeName): ?array
    {
        $synchronizationDataTransfer = new SynchronizationDataTransfer();
        $synchronizationDataTransfer
            ->setReference(static::REFERENCE_NAME . $identifier)
            ->setLocale($localeName)
            ->setStore($this->store->getStoreName());

        $key = $this->synchronizationService
            ->getStorageKeyBuilder(ProductStorageConstants::PRODUCT_ABSTRACT_RESOURCE_NAME)
            ->generateKey($synchronizationDataTransfer);
        $mappingResource = $this->storageClient->get($key);
        if (!$mappingResource) {
            return null;
        }

        if (!array_key_exists('key', $mappingResource)) {
            $mappingResource['key'] = sprintf('%s:%s:%s', ProductStorageConstants::PRODUCT_ABSTRACT_RESOURCE_NAME, strtolower($localeName), $mappingResource['id']);
        }

        return $this->storageClient->get($mappingResource['key']);
    }
}
