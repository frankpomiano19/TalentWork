<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Amount;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                'AUeaVUjJ_u0AFkpftQhEtq4cprIxQ8uqi4pVm76xaPOAgQMJ_VTMvaveHmzzGsgXehuvI8x6MJNPIjzu',
                'EGHT6oMxcsIe7wfsTRw8GvqSzwwiJVYLVgK4T8Pt599cddPPUo8w1AYtGyffFOrU48tFsDPuxfAbZdqw'
            )
        );
        // dd($payPalConfig['client_id'], ' : ', $payPalConfig['secret']);

        // $this->apiContext->setConfig($payPalConfig['settings']);
    }

    // ...

    public function payWithPayPal()
    {
        $payer = new Payer(); //Usuario que paga
        $payer->setPaymentMethod('paypal');

        $amount = new Amount(); // Total a pagar
        $amount->setTotal('3.99');
        $amount->setCurrency('USD');

        $transaction = new Transaction(); //Crea transaccion
        $transaction->setAmount($amount);
        // $transaction->setDescription('See your IQ results');

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl) // En caso de que el usuario no page o page
            ->setCancelUrl($callbackUrl); //Presiono cancelar

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        //Aca se procesa el pago
        try {
            $payment->create($this->apiContext);
            echo $payment;
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request)
    {
        dd($request->all());
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/paypal/failed')->with(compact('status'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            return redirect('/results')->with(compact('status'));
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/results')->with(compact('status'));
    }
}