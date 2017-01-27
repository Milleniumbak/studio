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
    // adiciona un item a paypal

    private function addItem($name, $cantidad, $precio){
        $item1 = new Item();
        $item1->setName($name)
        ->setCurrency('USD')
        ->setQuantity($cantidad)
        ->setPrice($precio);

        return $item1;
    }
    /**
     * Metodo que procesa el pago mediante paypal
     * @param float $montoTotal 
     */
    public function procesarPago($montoTotal, $imgEvents, $descCompra)
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

        $itemsArray = array();        
        // adicionamos todos los items
        foreach ($imgEvents as $key => $value) {
            $value = $this->addItem($value->path, 1, $value->price);
            array_push($itemsArray, $value);
        }
        $itemList = new ItemList();
        $itemList->setItems($itemsArray);

        // ### Additional payment details
        // Use this optional field to set additional
        // payment information such as tax, shipping
        // charges etc.
        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal(0);

        // ### Amount
        // Lets you specify a payment amount.
        // You can also specify additional details
        // such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($montoTotal)
            ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. 
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($descCompra)
            ->setInvoiceNumber(uniqid());

    // ### Redirect urls
    // Set the urls that the buyer must be redirected to after 
    // payment approval/ cancellation.
    //$baseUrl = getBaseUrl();
    $redirectUrls = new RedirectUrls();
    
    $redirectUrls->setReturnUrl("http://siagro.ddns.net/index.php?r=sbuyphoto/response&success=true")
        ->setCancelUrl('http://siagro.ddns.net/index.php?r=sbuyphoto/response&success=true');

    // ### Payment
    // A Payment Resource; create one using
    // the above types and intent set to 'sale'
    $payment = new Payment();
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));

        // For Sample Purposes Only.
        $request = clone $payment;

        // ### Create Payment
        // Create a payment by calling the 'create' method
        // passing it a valid apiContext.
        // (See bootstrap.php for more on `ApiContext`)
        // The return object contains the state and the
        // url to which the buyer must be redirected to
        // for payment approval
        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }

        // ### Get redirect url
        // The API response provides the url that you must redirect
        // the buyer to. Retrieve the url from the $payment->getApprovalLink()
        // method
        $approvalUrl = $payment->getApprovalLink();

        // ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

    return $payment;

    }
  
}