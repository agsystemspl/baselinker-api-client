<?php

namespace AGSystems\Baselinker\API;

/**
 * @method mixed addInventoryPriceGroup(array $parameters) The method allows to create a price group in BaseLinker storage. Providing a price group ID will update the existing price group. Such price groups may be later assigned in addInventory method.
 * @method mixed deleteInventoryPriceGroup(array $parameters)
 * @method mixed getInventoryPriceGroups(array $parameters)
 * @method mixed addInventoryWarehouse(array $parameters)
 * @method mixed deleteInventoryWarehouse(array $parameters)
 * @method mixed getInventoryWarehouses(array $parameters)
 * @method mixed addInventory(array $parameters)
 * @method mixed deleteInventory(array $parameters)
 * @method mixed getInventories(array $parameters)
 * @method mixed addInventoryCategory(array $parameters)
 * @method mixed deleteInventoryCategory(array $parameters)
 * @method mixed getInventoryCategories(array $parameters)
 * @method mixed addInventoryManufacturer(array $parameters)
 * @method mixed deleteInventoryManufacturer(array $parameters)
 * @method mixed getInventoryManufacturers(array $parameters)
 * @method mixed getInventoryExtraFields(array $parameters)
 * @method mixed getInventoryIntegrations(array $parameters)
 * @method mixed getInventoryAvailableTextFieldKeys(array $parameters)
 * @method mixed addInventoryProduct(array $parameters)
 * @method mixed deleteInventoryProduct(array $parameters)
 * @method mixed getInventoryProductsData(array $parameters)
 * @method mixed getInventoryProductsList(array $parameters)
 * @method mixed getInventoryProductsStock(array $parameters)
 * @method mixed updateInventoryProductsStock(array $parameters)
 * @method mixed getInventoryProductsPrices(array $parameters)
 * @method mixed updateInventoryProductsPrices(array $parameters)
 * @method mixed getInventoryProductLogs(array $parameters)

 * @method mixed getExternalStoragesList(array $parameters)
 * @method mixed getExternalStorageCategories(array $parameters)
 * @method mixed getExternalStorageProductsData(array $parameters)
 * @method mixed getExternalStorageProductsList(array $parameters)
 * @method mixed getExternalStorageProductsQuantity(array $parameters)
 * @method mixed getExternalStorageProductsPrices(array $parameters)
 * @method mixed updateExternalStorageProductsQuantity(array $parameters)

 * @method mixed getJournalList(array $parameters)
 * @method mixed addOrder(array $parameters)
 * @method mixed getOrderSources(array $parameters)
 * @method mixed getOrderExtraFields(array $parameters)
 * @method mixed getOrders(array $parameters)
 * @method mixed getOrderTransactionDetails(array $parameters)
 * @method mixed getOrdersByEmail(array $parameters)
 * @method mixed getOrdersByPhone(array $parameters)
 * @method mixed addInvoice(array $parameters)
 * @method mixed getInvoices(array $parameters)
 * @method mixed getSeries(array $parameters)
 * @method mixed getOrderStatusList(array $parameters)
 * @method mixed getOrderPaymentsHistory(array $parameters)
 * @method mixed getNewReceipts(array $parameters)
 * @method mixed getReceipt(array $parameters)
 * @method mixed setOrderFields(array $parameters)
 * @method mixed addOrderProduct(array $parameters)
 * @method mixed setOrderProductFields(array $parameters)
 * @method mixed deleteOrderProduct(array $parameters)
 * @method mixed setOrderPayment(array $parameters)
 * @method mixed setOrderStatus(array $parameters)
 * @method mixed setOrderReceipt(array $parameters)
 * @method mixed addOrderInvoiceFile(array $parameters)

 * @method mixed createPackage(array $parameters)
 * @method mixed createPackageManual(array $parameters)
 * @method mixed getCouriersList(array $parameters)
 * @method mixed getCourierFields(array $parameters)
 * @method mixed getCourierServices(array $parameters)
 * @method mixed getCourierAccounts(array $parameters)
 * @method mixed getLabel(array $parameters)
 * @method mixed getProtocol(array $parameters)
 * @method mixed getOrderPackages(array $parameters)
 * @method mixed getCourierPackagesStatusHistory(array $parameters)
 * @method mixed deleteCourierPackage(array $parameters)
 * @method mixed requestParcelPickup(array $parameters)
 * @method mixed getRequestParcelPickupFields(array $parameters)
 */
class Client
{
    protected $connector = 'https://api.baselinker.com/connector.php';
    protected $accessToken;

    public function __construct($accessToken, $client = null)
    {
        if (is_null($client))
            $client = new \GuzzleHttp\Client();

        $this->client = $client;
        $this->accessToken = $accessToken;
    }

    public function __call($name, $arguments)
    {
        $form_params = [
            'method' => $name,
        ];

        if ($parameters = array_shift($arguments)) {
            $form_params += [
                'parameters' => json_encode($parameters),
            ];
        }

        $response = $this->client->request('POST', $this->connector, [
            'form_params' => $form_params,
            'headers' => [
                'X-BLToken' => $this->accessToken
            ]
        ]);

        $result = json_decode($response->getBody()->getContents());

        return $result;
    }
}
