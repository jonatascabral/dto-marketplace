<?php

namespace GFG\DTOMarketplace\Context\Partner\Order;

use GFG\DTOContext\DataWrapper\Mock;

class CreateTest extends \PHPUnit_Framework_TestCase
{
    private $context;

    public function setup()
    {
        $this->dw = Mock::create(
            'GFG\DTOMarketplace\DataWrapper\Order\Order',
            $this
        );
        $this->context = new Create($this->dw);
    }

    public function testExportContextData()
    {
        $hash           = 'hash';
        $info           = [];
        $orderNr        = 123;
        $createdAt      = '2016-01-01 00:00:01';
        $address        = 'Rua Direita, 1';
        $freightCost    = 10.00;
        $sku            = 'simple sku';
        $id             = 1;
        $price          = 10.00;
        $unitPrice      = 1;
        $taxAmount      = 2;
        $taxPercent     = 3;
        $idSalesOrderItem = 1;
        $supplierDeliveryTime = 321;
        $shipmentType = 222;
        $shipmentDate = 123214;
        $shipmentFee = 11211;
        $paymentMethod = 'braspag';
        $voucherCode = 'y';
        $giftOption = 'go';
        $giftMessage = 'gm';
        $sellerId = 'si';
        $skuSupplier = 'ss';
        $bobOrderId = 'champs';
        $installmentCount = 2;


        //items
        $item = Mock::create('GFG\DTOMarketplace\DataWrapper\Order\Item', $this);
        $item->method('getId')->willReturn($idSalesOrderItem);
        $item->method('getSku')->willReturn($sku);
        $item->method('getPrice')->willReturn($price);
        $item->method('getUnitPrice')->willReturn($unitPrice);
        $item->method('getTaxAmount')->willReturn($taxAmount);
        $item->method('getTaxPercent')->willReturn($taxPercent);
        $item->method('getShipmentType')->willReturn($shipmentType);
        $item->method('getShipmentDate')->willReturn($shipmentDate);
        $item->method('getShipmentFee')->willReturn($shipmentFee);
        $item->method('getSupplierDeliveryTime')->willReturn($supplierDeliveryTime);
        $item->method('getSellerId')->willReturn($sellerId);
        $item->method('getSkuSupplier')->willReturn($skuSupplier);

        $itemCollection = [$item];

        //addresses
        $street       = 'Rua da Glória';
        $streetNumber = '1';
        $complement   = 'Complemento';
        $city         = 'São Paulo';
        $postCode     = '04327-130';
        $neighborhood = 'Centro';
        $regionCode   = 'SP';
        $phone        = '99999-9999';
        $phone2       = '99999-9991';

        $shippingAddressDataWrapper = Mock::create(
            'GFG\DTOMarketplace\DataWrapper\Order\Address',
            $this
        );

        $shippingAddressDataWrapper->method('getStreet')->willReturn($street);
        $shippingAddressDataWrapper->method('getNumber')->willReturn($streetNumber);
        $shippingAddressDataWrapper->method('getComplement')->willReturn($complement);
        $shippingAddressDataWrapper->method('getCity')->willReturn($city);
        $shippingAddressDataWrapper->method('getPostCode')->willReturn($postCode);
        $shippingAddressDataWrapper->method('getRegionCode')->willReturn($regionCode);
        $shippingAddressDataWrapper->method('getNeighborhood')->willReturn($neighborhood);
        $shippingAddressDataWrapper->method('getPhone')->willReturn($phone);
        $shippingAddressDataWrapper->method('getPhone2')->willReturn($phone2);

        $shippingAddress = [
            'street'        => $street,
            'number'        => $streetNumber,
            'complement'    => $complement,
            'city'          => $city,
            'postcode'      => $postCode,
            'neighborhood'  => $neighborhood,
            'region_code'   => $regionCode,
            'phone'         => $phone,
            'phone2'        => $phone2,
        ];

        $billingAddressDataWrapper = Mock::create(
            'GFG\DTOMarketplace\DataWrapper\Order\Address',
            $this
        );

        $billingAddressDataWrapper->method('getStreet')->willReturn($street);
        $billingAddressDataWrapper->method('getNumber')->willReturn($streetNumber);
        $billingAddressDataWrapper->method('getComplement')->willReturn($complement);
        $billingAddressDataWrapper->method('getCity')->willReturn($city);
        $billingAddressDataWrapper->method('getPostCode')->willReturn($postCode);
        $billingAddressDataWrapper->method('getRegionCode')->willReturn($regionCode);
        $billingAddressDataWrapper->method('getNeighborhood')->willReturn($neighborhood);
        $billingAddressDataWrapper->method('getPhone')->willReturn($phone);
        $billingAddressDataWrapper->method('getPhone2')->willReturn($phone2);

        $billingAddress = [
            'street'        => $street,
            'number' => $streetNumber,
            'complement'    => $complement,
            'city'          => $city,
            'postcode'      => $postCode,
            'neighborhood'  => $neighborhood,
            'region_code'   => $regionCode,
            'phone'         => $phone,
            'phone2'        => $phone2,
        ];

        //\addresses

        //customer
        $email      = 'email@site.com';
        $idCustomer = 1;
        $firstName  = 'John';
        $lastName   = 'Armless';
        $document   = '810.857.546-00';
        $birthday   = '01-01-1991';

        $customerDataWrapper = $this->getMockBuilder('GFG\DTOMarketplace\DataWrapper\Customer')
            ->disableOriginalConstructor()
            ->setMethods([
                'getIdCustomer',
                'getEmail',
                'getFirstName',
                'getLastName',
                'getDocument',
                'getBirthday',
            ])
            ->getMock();

        $customerDataWrapper->method('getIdCustomer')->willReturn($idCustomer);
        $customerDataWrapper->method('getEmail')->willReturn($email);
        $customerDataWrapper->method('getFirstName')->willReturn($firstName);
        $customerDataWrapper->method('getLastName')->willReturn($lastName);
        $customerDataWrapper->method('getDocument')->willReturn($document);
        $customerDataWrapper->method('getBirthday')->willReturn($birthday);

        $customer = [
            'email'       => $email,
            'first_name'  => $firstName,
            'last_name'   => $lastName,
            'document'    => $document,
            'birthday'    => $birthday
        ];
        //\customer

        $exportedData   = [
            'name' => 'gfg.dtomarketplace.context.partner.order.create',
            'info' => $info,
            'hash' => $this->context->getHash(),
            'data_wrapper' => get_class($this->dw),
            'data' => [
                'order_nr'        => $orderNr,
                'bob_order_id'    => $bobOrderId,
                'payment_method'  => $paymentMethod,
                'voucher_code'    => $voucherCode,
                'gift_option'     => $giftOption,
                'gift_message'    => $giftMessage,
                'created_at'      => $createdAt,
                'freight_cost'    => $freightCost,
                'installment_count' => $installmentCount,
                'item_collection' => [
                    0 =>[
                        'id'    => $idSalesOrderItem,
                        'sku'   => $sku,
                        'price' => $price,
                        'unit_price' => $unitPrice,
                        'tax_amount' => $taxAmount,
                        'tax_percent' => $taxPercent,
                        'shipment_type' => $shipmentType,
                        'shipment_date' => $shipmentDate,
                        'shipment_fee' => $shipmentFee,
                        'supplier_delivery_time' => $supplierDeliveryTime,
                        'seller_id' => $sellerId,
                        'sku_supplier' => $skuSupplier,
                    ],
                ],
                'customer'        => $customer,
                'shipping_address' => $shippingAddress,
                'billing_address'  => $billingAddress
            ]
        ];

        $this->dw->method('getOrderNr')->willReturn($orderNr);
        $this->dw->method('getBobOrderId')->willReturn($bobOrderId);
        $this->dw->method('getPaymentMethod')->willReturn($paymentMethod);
        $this->dw->method('getVoucherCode')->willReturn($voucherCode);
        $this->dw->method('getGiftOption')->willReturn($giftOption);
        $this->dw->method('getGiftMessage')->willReturn($giftMessage);
        $this->dw->method('getCreatedAt')->willReturn($createdAt);
        $this->dw->method('getFreightCost')->willReturn($freightCost);
        $this->dw->method('getInstallmentCount')->willReturn($installmentCount);
        $this->dw->method('getItemCollection')->willReturn($itemCollection);
        $this->dw->method('getCustomer')->willReturn($customerDataWrapper);
        $this->dw->method('getShippingAddress')->willReturn($shippingAddressDataWrapper);
        $this->dw->method('getBillingAddress')->willReturn($billingAddressDataWrapper);

        $this->assertSame($exportedData, $this->context->exportContextData());
    }

    public function testGetHttpMethod()
    {
        $this->assertSame('post', $this->context->getHttpMethod());
    }
}
