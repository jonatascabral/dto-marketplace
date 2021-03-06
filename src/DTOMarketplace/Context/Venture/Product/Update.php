<?php

namespace GFG\DTOMarketplace\Context\Venture\Product;

use GFG\DTOMarketplace\Context\Base;
use GFG\DTOMarketplace\DataWrapper\Catalog\Simple;

class Update extends Base
{
    /**
     * {@inheritdoc}
     */
    public function getHttpMethod()
    {
        return 'put';
    }

    /**
     * {@inheritdoc}
     */
    public function exportContextData()
    {
        $dataWrapper      = $this->getDataWrapper();
        $simpleCollection = [];
        $imageCollection  = [];

        /** @var Simple $simple */
        foreach ($dataWrapper->getSimpleCollection() as $simple) {
            $simpleCollection[] = [
                'sku'         => $simple->getSku(),
                'partner_sku' => $simple->getPartnerSku(),
                'venture_product_id' => $simple->getVentureProductId(),
                'variation'   => $simple->getVariation(),
                'ean'         => $simple->getEan(),
                'attributes'  => $simple->getAttributes(),
                'status'      => $simple->getStatus()
            ];
        }

        foreach ($dataWrapper->getImageCollection() as $image) {
            $imageCollection[] = [
                'url'      => $image->getUrl(),
                'position' => $image->getPosition()
            ];
        }

        return $this->prepareExport([
            'sku'                    => $dataWrapper->getSku(),
            'partner_sku'            => $dataWrapper->getPartnerSku(),
            'name'                   => $dataWrapper->getName(),
            'description'            => $dataWrapper->getDescription(),
            'brand'                  => $dataWrapper->getBrand(),
            'attributes'             => $dataWrapper->getAttributes(),
            'attribute_set'          => $dataWrapper->getAttributeSet(),
            'image_collection'       => $imageCollection,
            'simple_collection'      => $simpleCollection,
            'supplier_delivery_time' => $dataWrapper->getSupplierDeliveryTime(),
            'shipment_type'          => $dataWrapper->getShipmentType(),
            'status'                 => $dataWrapper->getStatus()
        ]);
    }
}
