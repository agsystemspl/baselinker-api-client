<?php

namespace AGSystems\Baselinker\API;

/**
 * @method mixed addCategory(array $parameters)
 * @method mixed addProduct(array $parameters)
 * @method mixed addProductVariant(array $parameters)
 * @method mixed deleteCategory(array $parameters)
 * @method mixed deleteProduct(array $parameters)
 * @method mixed deleteProductVariant(array $parameters)
 * @method mixed getCategories(array $parameters)
 * @method mixed getProductsData(array $parameters)
 * @method mixed getProductsList(array $parameters)
 * @method mixed getStoragesList()
 * @method mixed updateProductsQuantity(array $parameters)
 * @method mixed updateProductsPrices(array $parameters)
 *
 * @method mixed getJournalList(array $parameters)
 * @method mixed addOrder(array $parameters)
 * @method mixed getOrders(array $parameters)
 * @method mixed getOrdersByEmail(array $parameters)
 * @method mixed getInvoices(array $parameters)
 * @method mixed getOrderStatusList(array $parameters)
 * @method mixed getNewReceipts(array $parameters)
 * @method mixed setOrderFields(array $parameters)
 * @method mixed setOrderPayment(array $parameters)
 * @method mixed setOrderStatus(array $parameters)
 * @method mixed setOrderReceipt(array $parameters)
 *
 * @method mixed createPackage(array $parameters)
 * @method mixed createPackageManual(array $parameters)
 * @method mixed getCouriersList()
 * @method mixed getCourierFields(array $parameters)
 * @method mixed getCourierServices(array $parameters)
 * @method mixed getCourierAccounts(array $parameters)
 * @method mixed getLabel(array $parameters)
 * @method mixed getOrderPackages(array $parameters)
 * @method mixed getCourierPackagesStatusHistory(array $parameters)
 */
class Client
{
    protected $connector = 'https://api.baselinker.com/connector.php';
    protected $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function __call($name, $arguments)
    {
        $client = new \GuzzleHttp\Client();

        $form_params = [
            'token' => $this->accessToken,
            'method' => $name,
        ];

        if ($parameters = array_shift($arguments)) {
            $form_params += [
                'parameters' => json_encode($parameters),
            ];
        }

        $response = $client->request('POST', $this->connector, [
            'form_params' => $form_params,
        ]);

        $result = json_decode($response->getBody()->getContents());

        return $result;
    }
}
