<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

use Illuminate\Http\Request;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Redirect;
use Session;
use URL;
use Srmklive\PayPal\Services\ExpressCheckout;

class Payamountpaypal extends Controller
{

	private $_api_context;

	public function __costruct(){
		//config the paypal config file
		$paypal_config = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_config['client_id'],
            $paypal_config['secret'])
        );
        $this->_api_context->setConfig($paypal_config['settings']);

	}


    public function index_load_page(){
    	return view('siteusers.pay_amount.paypal_pay');
    }



    public function payWithpaypal(Request $request)
    {
		$payer = new Payer();
		        $payer->setPaymentMethod('paypal');
		$item_1 = new Item();
		$item_1->setName('Item 1') /** item name **/
		            ->setCurrency('USD')
		            ->setQuantity(1)
		            ->setPrice($request->get('amount')); /** unit price **/
		$item_list = new ItemList();
		        $item_list->setItems(array($item_1));
		$amount = new Amount();
		        $amount->setCurrency('USD')
		            ->setTotal($request->get('amount'));
		$transaction = new Transaction();
		        $transaction->setAmount($amount)
		            ->setItemList($item_list)
		            ->setDescription('Your transaction description');
		$redirect_urls = new RedirectUrls();
		        $redirect_urls->setReturnUrl(URL::route('paypalloadingpage')) /** Specify return URL **/
		            ->setCancelUrl(URL::route('paypalloadingpage'));
		$payment = new Payment();
		        $payment->setIntent('Sale')
		            ->setPayer($payer)
		            ->setRedirectUrls($redirect_urls)
		            ->setTransactions(array($transaction));
		        /** dd($payment->create($this->_api_context));exit; **/
		        try {
		$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
		if (\Config::get('app.debug')) {
		\Session::put('error', 'Connection timeout');
		                return redirect()->route('paywithpaypal');
		} else {
		\Session::put('error', 'Some error occur, sorry for inconvenient');
		                return redirect()->route('paywithpaypal');
		}
		}
		foreach ($payment->getLinks() as $link) {
		if ($link->getRel() == 'approval_url') {
		$redirect_url = $link->getHref();
		                break;
		}
		}
		/** add payment ID to session **/
		        Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {
		/** redirect to paypal **/
		            //return Redirect::away($redirect_url);
					echo "@";
		}
		\Session::put('error', 'Unknown error occurred');
		        return redirect()->route('paywithpaypal');
		}






















		 public function payment()

    {

        $data = [];

        $data['items'] = [

            [

                'name' => 'ItSolutionStuff.com',

                'price' => 100,

                'desc'  => 'Description for ItSolutionStuff.com',

                'qty' => 1

            ]

        ];



        $data['invoice_id'] = 1;

        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";

        $data['return_url'] = route('payment.success');

        $data['cancel_url'] = route('payment.cancel');

        $data['total'] = 100;



        $provider = new ExpressCheckout;



        $response = $provider->setExpressCheckout($data);



        $response = $provider->setExpressCheckout($data, true);



        return "ss";

    }

    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function cancel()

    {

        dd('Your payment is canceled. You can create cancel page here.');

    }



    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function success(Request $request)

    {

        $response = $provider->getExpressCheckoutDetails($request->token);



        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            dd('Your payment was successfully. You can create success page here.');

        }



        dd('Something is wrong.');

    }




}