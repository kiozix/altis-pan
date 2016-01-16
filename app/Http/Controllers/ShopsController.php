<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\ShopsRequest;
use App\Shops;
use App\Paypal;
use App\Behaviour\PaypalPayment;

class ShopsController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index']]);
		$this->middleware('arma', ['except' => ['index']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$shops = Shops::all();
		return view('shops.index', compact('shops'));
	}

	/**
	 * @return \Illuminate\View\View
     */
	public function accepted(Request $request)
	{
		if(empty(Input::get('token')) && empty(Input::get('PayerID'))){
			return Response::view('errors.403', array(), 403);
		}

		$id = Session::get('shop.id');
		$shops = Shops::where('id', $id)->firstOrFail();

		$token = Input::get('token');
		$PayerID = Input::get('PayerID');

		$paypal = new PaypalPayment();

		$response = $paypal->request('GetExpressCheckoutDetails', array('TOKEN' => $token));

		if($response){
			if($response['CHECKOUTSTATUS'] == 'PaymentActionCompleted'){
				return redirect('/shop/payment/failed');
			}
		}else{
			return redirect('/shop/payment/failed');
			// var_dump($paypal->errors);
			// die();
		}

		$params = array(
			'TOKEN' => $token,
			'PAYERID'=> $PayerID,
			'PAYMENTACTION' => 'Sale',

			'PAYMENTREQUEST_0_AMT' => $shops->price,
			'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',

			'L_PAYMENTREQUEST_0_NAME0' => $shops->name,
			'L_PAYMENTREQUEST_0_AMT0' => $shops->price,
			'L_PAYMENTREQUEST_0_QTY0' => 1,
		);

		$response = $paypal->request('DoExpressCheckoutPayment',$params);

		if($response){
			// dd($response);
			$transaction_id = $response['PAYMENTINFO_0_TRANSACTIONID'];

			$paypal_store = New Paypal();
			$paypal_store->id_shop = $shops->name;
			$paypal_store->id_user = $request->user()->name;
			$paypal_store->id_transaction = $transaction_id;
			$paypal_store->price = $shops->price;
			$paypal_store->save();


			return view('shops.accepted');

		}else{
			return redirect('/shop/payment/failed');
			// dd($paypal->errors);
		}

	}

	/**
	 * @return \Illuminate\View\View
     */
	public function failed()
	{
		return view('shops.failed');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$shops = new Shops();
		return view('shops.create', compact('shops'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ShopsRequest $request)
	{
		Shops::create($request->only('name', 'time', 'content', 'price', 'image'));
		return redirect(action('ShopsController@index'))->with('success', 'L\'offre à bien été ajouter');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$shops = Shops::where('id', $id)->firstOrFail();

		Session::put('shop.id', $shops->id);

		$paypal = new PaypalPayment();

		$params = array(
			'RETURNURL' => url('/shop/payment/accepted'),
			'CANCELURL' => url('/shop/payment/failed'),

			'PAYMENTREQUEST_0_AMT' => $shops->price,
			'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',

			'L_PAYMENTREQUEST_0_NAME0' => $shops->name,
			'L_PAYMENTREQUEST_0_AMT0' => $shops->price,
			'L_PAYMENTREQUEST_0_QTY0' => 1,
		);

		$response = $paypal->request('SetExpressCheckout', $params);

		if($response){
			$paypal = 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=' . $response['TOKEN'];
		}else{
			dd($paypal->errors);
			die('Erreur ');
		}

		return view('shops.show', compact('shops', 'paypal'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$shops = Shops::findOrFail($id);
		return view('shops.edit', compact('shops'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, ShopsRequest $request)
	{
		$shops = Shops::findOrFail($id);
		$shops->update($request->only('name', 'time', 'content', 'price', 'image'));
		return redirect(action('ShopsController@index'))->with('success', 'L\'offre à bien été modifiée');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$shops = Shops::findOrFail($id);
		$shops->delete();
		return redirect(action('ShopsController@index'))->with('success', 'L\'offre à bien été supprimé');
	}

}
