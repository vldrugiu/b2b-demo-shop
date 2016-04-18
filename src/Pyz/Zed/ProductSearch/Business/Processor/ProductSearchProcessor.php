<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductSearch\Business\Processor;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\ProductSearch\Business\Processor\ProductSearchProcessor as SprykerProductSearchProcessor;

class ProductSearchProcessor extends SprykerProductSearchProcessor
{

    /**
     * @param array $productData
     * @param \Generated\Shared\Transfer\LocaleTransfer $locale
     *
     * @return array
     */
    protected function buildBaseProduct(array $productData, LocaleTransfer $locale)
    {
        $baseProduct = parent::buildBaseProduct($productData, $locale);

        $attributes = $this->getProductAttributes($productData);

        $baseProduct[PageIndexMap::SEARCH_RESULT_DATA]['image_url'] = $attributes['image_big'];
        $baseProduct[PageIndexMap::SEARCH_RESULT_DATA]['thumbnail_url'] = $attributes['image_small'];

        $baseProduct[PageIndexMap::SEARCH_RESULT_DATA]['price'] = $productData['price'];
        $baseProduct[PageIndexMap::INTEGER_SORT]['price'] = $productData['price'];

        $baseProduct[PageIndexMap::INTEGER_FACET][] = [
            'facet-name' => 'price',
            'facet-value' => $productData['price'],
        ];

        return $baseProduct;
    }

    /**
     * @param array $productData
     *
     * @return array
     */
    protected function getProductAttributes(array $productData)
    {
        $baseAttributes = $this->getBaseProductAttributes($productData);
        $localizedAttributes = $this->getLocalizedProductAttributes($productData);

        $attributes = array_merge($baseAttributes, $localizedAttributes);

        return $attributes;
    }

    /**
     * @param array $productData
     *
     * @return array
     */
    protected function getBaseProductAttributes(array $productData)
    {
        $productAttributes = $this->getEncodedData($productData['concrete_attributes']);
        $abstractAttributes = $this->getEncodedData($productData['abstract_attributes']);

        $attributes = array_merge($abstractAttributes, $productAttributes);

        return $attributes;
    }

    /**
     * @param array $productData
     *
     * @return array
     */
    protected function getLocalizedProductAttributes(array $productData)
    {
        $productAttributes = $this->getEncodedData($productData['concrete_localized_attributes']);
        $abstractAttributes = $this->getEncodedData($productData['abstract_localized_attributes']);

        $attributes = array_merge($abstractAttributes, $productAttributes);

        return $attributes;
    }

    /**
     * @param string $data
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    private function getEncodedData($data)
    {
        $encoded = json_decode($data, true);

        if (json_last_error()) {
            // @todo because of malformed strings we cant convert to an array
            return [];
//            throw new \InvalidArgumentException(json_last_error_msg() . ': ' . $data);
        }

        return $encoded;
    }

}
