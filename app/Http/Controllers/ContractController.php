<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contract;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use App\Models\use_tal;
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
class ContractController extends Controller
{

    private $apiContext;
    public function constructPayment(){
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );
        $this->apiContext->setConfig($payPalConfig['settings']);

    }

    // Limpia 1 elemento y todos del carrito
    public function clearCart($userId){
        \Cart::session(auth()->user()->id)->clearItemConditions($userId);
        \Cart::session(auth()->user()->id)->remove($userId);        
        foreach (\Cart::session(auth()->user()->id)->getContent() as $itemD) {
            \Cart::session(auth()->user()->id)->clearItemConditions($itemD->id);
        }
        \Cart::session(auth()->user()->id)->clear();
        // \Cart::clear();
        \Cart::session(auth()->user()->id)->clearCartConditions();
        return back();
    }    

    // Limpia todos los elementos del carrito

    public function clearAllCart(){
        \Cart::session(auth()->user()->id)->clear();
        \Cart::session(auth()->user()->id)->clearCartConditions();

    }

    
    public function validationFieldDescriptionContract(Request $request){
        $validationConfirm = $this->validationRegisterContract($request);

        if($validationConfirm->fails()){
            $errorRegisterFailed = "No se pudo ejecutar el contrato por las siguientes razones : "; 
            return back()->withErrors($validationConfirm,'contractProccessForm')->with('contractFailed',$errorRegisterFailed)->withInput();
        }else{
            $this->clearAllCart();
            \Cart::session(auth()->user()->id)->add(array(
                'id' => $request->serviceOffer, // inique row ID
                'name' => 'No name',
                'price' =>$request->priceOffer,
                'quantity' =>1,            
                'attributes' => array(
                    'userOffer' => $request->userOffer,
                    'dateForm'=>$request->dateForm,
                    'hourForm'=>$request->hourForm,
                    'addressForm'=>$request->addressForm,
                    'descriptionForm'=>$request->descriptionForm,
                    'typeOfJob'=>$request->typeOfJob,
                    'img1'=>$request->img1
                ),
            ));                     
            return redirect()->route('index.checkout');
        }

    }

    public function checkoutPaymentView(){
        // dd(\Cart::session(auth()->user()->id)->getContent());
        return view('checkoutPayment');
    }

    public function contractProcess(Request $request){
        $validationConfirm = $this->validationRegisterContract($request);
        if($validationConfirm->fails()){
            $errorRegisterFailed = "No se pudo ejecutar el contrato por las siguientes razones : "; 
            return back()->withErrors($validationConfirm,'contractProccessForm')->with('contractFailed',$errorRegisterFailed)->withInput();
        }
        // 1 : Para oficios
        // 2 : Para talentos
        $message = $this->contractCreate($request);
        // return back()->with('contractMessage',$message);
    }

    public function contractCreate(Request $request){
        $message='';
        switch($request->typeOfJob){
            case 1:
                $message = "Contratado el oficio correctamente";
                $contractNow = Contract::create([
                    'con_contract_date'=>$request->dateForm,
                    'con_hour'=>$request->hourForm,
                    'con_address'=>$request->addressForm,
                    'con_description'=>$request->descriptionForm,
                    'con_price'=>$request->priceOffer,
                    'con_initial'=>Carbon::now(),
                    'use_offer'=>$request->userOffer,
                    'use_receive'=>auth()->user()->id,
                    'use_occ_id'=>$request->serviceOffer,
                ]);
        
                break;
            case 2:
                $message = "Contratado el talento correctamente";
                $contractNow = Contract::create([
                    'con_contract_date'=>$request->dateForm,
                    'con_hour'=>$request->hourForm,
                    'con_address'=>$request->addressForm,
                    'con_description'=>$request->descriptionForm,
                    'con_price'=>$request->priceOffer,
                    'con_initial'=>Carbon::now(),
                    'use_offer'=>$request->userOffer,
                    'use_receive'=>auth()->user()->id,
                    'use_tal_id'=>$request->serviceOffer,
                ]);

                break;
            default:
                $message = "Error no se pudo crear el contrato";
                break;
        }
        return $message;
    }

    public function validationRegisterContract(Request $request){
        $fieldCreate= [
            'userOffer'=>'required|integer|min:0',
            'priceOffer'=>'required|numeric|between:0,9999.99',
            'dateForm'=>'required|date',
            'hourForm'=>'required',
            'addressForm'=>'required|string',
            'descriptionForm'=>'required|string',
            'serviceOffer'=>'required'
        ];
        $messageError=[
            'required' =>'Este campo ":attribute" es obligatorio',
            'integer'=>'":attribute" Debe ser numero entero',
            'between:0,9999.99'=>'":attribute" Fuera del rango',
            'numeric'=>'":attribute" Debe ser numerico',
            'min:0'=>'":attribute" Minimo es 0',
            'string'=>'":attribute" Debe ser texto'
        ];
        $validacion = Validator::make($request->all(),$fieldCreate,$messageError);
        return $validacion;        
    }



    public function processPaymentServiceContract()
    {
        
        $this->constructPayment();
        
        
        // Validacion de contrato
        $algo = "Nada";   
        $algo = $this->getOneItemFromCart();     
        $requestItems = $this->generateRequestFromArray($algo);       
        $validationConfirm = $this->validationRegisterContract($requestItems);
        if($validationConfirm->fails()){
            $errorRegisterFailed = "No se pudo ejecutar el contrato por las siguientes razones : "; 
            return back()->withErrors($validationConfirm,'contractProccessForm')->with('contractFailed',$errorRegisterFailed)->withInput();
        }
        // Fin de validacion de contrato

        $payer = new Payer(); //Usuario que paga
        $payer->setPaymentMethod('paypal');

        $amount = new Amount(); // Total a pagar
        $amount->setTotal($requestItems->priceOffer);
        $amount->setCurrency('USD');

        $transaction = new Transaction(); //Crea transaccion
        $transaction->setAmount($amount);
        $transaction->setDescription($requestItems->descriptionForm);

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
        $this->constructPayment();

        // Validacion de datos

        foreach (\Cart::session(auth()->user()->id)->getContent() as $itemD) {
            
        }

        $requestItems = new Request([

        ]);
        $this->validationRegisterContract($requestItems);

        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect(route('index.checkout'))->with('paymentFailedOrCancel',$status);
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Ejecutar pago **/
        $result = $payment->execute($execution, $this->apiContext);
        if ($result->getState() === 'approved') {
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';

            //  Se registra el contrato
            $algo = "Nada";   
            $algo = $this->getOneItemFromCart();      
            $requestItems = $this->generateRequestFromArray($algo);       
            $this->contractProcess($requestItems);
            $this->clearAllCart();
            // Fin de registro de contrato
            if($requestItems->typeOfJob == 1){
                return redirect(route('showProfileServiceOccupation',$requestItems->serviceOffer))->with('statusPaymentSuccess',$status);
            }
            if($requestItems->typeOfJob == 2){
                return redirect(route('showProfileServiceTalent',$requestItems->serviceOffer))->with('statusPaymentSuccess',$status);

                // return redirect('/profileServiceTalent/1')->with('statusPaymentSuccess',$status);
            }

        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        if($requestItems->typeOfJob == 1){
            return redirect(route('showProfileServiceOccupation',$requestItems->serviceOffer))->with('statusPaymentFailed',$status);
        }
        if($requestItems->typeOfJob == 2){
            return redirect(route('showProfileServiceTalent',$requestItems->serviceOffer))->with('statusPaymentFailed',$status);

        }


    }    


    // Ayudantes
    public function getOneItemFromCart(){
        $itemOne="NoValue";
        foreach (\Cart::session(auth()->user()->id)->getContent() as $itemD) {
            $itemOne=$itemD;
            break;
        }
        return $itemOne;
        
    }
    public function generateRequestFromArray($arrayToRequest){

        
        $requestItems = new Request([
            'dateForm'=>$arrayToRequest->attributes->dateForm,
            'hourForm'=>$arrayToRequest->attributes->hourForm,
            'addressForm'=>$arrayToRequest->attributes->addressForm,
            'descriptionForm'=>$arrayToRequest->attributes->descriptionForm,
            'priceOffer'=>$arrayToRequest->price,
            'userOffer'=>$arrayToRequest->attributes->userOffer,
            'serviceOffer'=>$arrayToRequest->id,
            'typeOfJob'=>$arrayToRequest->attributes->typeOfJob
        ]);
        return $requestItems;

    }
}
