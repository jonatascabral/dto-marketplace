<?php

namespace GFG\DTOMarketplace\DataWrapper\Catalog;

use Context\DataWrapper\BaseCollection;

class ImageCollection extends BaseCollection
{
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'GFG\DTOMarketplace\DataWrapper\Catalog\Image';
    }
}
