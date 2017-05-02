<?php
/**
 * File Paypal.php.
 *
 * @author Marcio Camello <marciocamello@outlook.com>
 * @see https://github.com/paypal/rest-api-sdk-php/blob/master/sample/
 * @see https://developer.paypal.com/webapps/developer/applications/accounts
 */

namespace app\common\components;

use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\base\Component;
use yii\helpers\Url;

use PayPal\Api\Address;
use PayPal\Api\CreditCard;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\FundingInstrument;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;



class paypal extends Component
{
    public $moneda = "USD";
    // adiciona un item a paypal
    private function addItem($name, $cantidad, $precio){
        $item1 = new Item();
        $item1->setName($name)
        ->setCurrency($this->moneda)
        ->setQuantity($cantidad)
        ->setPrice($precio);

        return $item1;
    }
    /**
     * Metodo que procesa el pago mediante paypal
     * @param array $items de tipo compraimpresa,
     * @param string $descCompra descripcion de la compra
     */
    public function procesarPago($comprasimpresas, $descCompra)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                // id cliente
            'ATDgmaIhqu5-3WrBy0PpavsZ9aNR6chs2Q0-GSzmwaWgeJ5nRfkejXdvVCiZ9NvOpOeyqF_9YxnhKEva',
            // ClientSecret
            'ECSMT2Lsfk0lWa8_x-ph7Ze24bUGkCTlrE54bdUw49HmMIQPUlFOAVJJ6XKestEc6C64kjzUlUhDqpsn'
            )
        );


        //creamos el pago
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // total de la compra
        $subtotal = 0;
        $itemsArray = array();
        // adicionamos todos los items
        foreach ($comprasimpresas as $key => $value) {
                            #addItem($name, $cantidad, $precio){
            $producto = $this->addItem($value->destipocompra, $value->cantidad, $value->precio);
            array_push($itemsArray, $producto);
            $subtotal = $subtotal + ($value->cantidad * $value->precio);
        }

        $itemList = new ItemList();
        $itemList->setItems($itemsArray);

        // ### opcionalmente se crea un objeto Details
        // Es cuando tenemos un costo por el envio del producto
        $details = new Details();
        $details->setSubtotal($subtotal);
        # lo de abajo es opcional cuando tenemos
        #$details->setShipping(0) costo por el envio
        #$details->setTax(0); costo por el impuesto

        // ### Amount
        // aqui especificamos los montos a pagar
        // You can also specify additional details
        // such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency($moneda)
            ->setTotal($subtotal)
            ->setDetails($details);

        // ### Transaction
        // definimos la transaccion
        // payment - what is the payment for and who
        // is fulfilling it.
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($descCompra) # descripcion de la compra
            ->setInvoiceNumber(uniqid());

    // ### Redireccionamiento de las urls
    // Establecemos la url para que el comprador pueda ser redirigido despues
    // payment approval/ cancellation.
    //$baseUrl = getBaseUrl();
    $redirectUrls = new RedirectUrls();

    $redirectUrls->setReturnUrl("http://desing.ddns.net/index.php?r=sbuyphoto/response");
    $redirectUrls->setCancelUrl('http://siagro.ddns.net/index.php?r=sbuyphoto/response');

    // ### Payment
    // Objeto a traves del cual se realizara el pago
    $payment = new Payment();
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));

        // For Sample Purposes Only.
        $request = clone $payment;

        // ### Create Payment
        // Creamos el pago llamando al metodo Create
        // pasando una apiContext valido.
        // El objeto devuelto contiene el estado y
        // la url al cual el comprador sera redirigido
        // para la aprobacion del pago
        try {
            $payment->create($apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            ResultPrinter::printError("Pago creado con PayPal. Por favor, visite la URL para Aprobar.", "Payment", null, $request, $ex);
            exit(1);
        }

        // ### Get redirect url
        // The API response provides the url that you must redirect
        // the buyer to. Retrieve the url from the $payment->getApprovalLink()
        // method
        $approvalUrl = $payment->getApprovalLink();
        voy por el minuto 15
        // ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

    return $payment;

    }

}
