<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\ShopsRequest;
use App\Shops;
use App\Paypal;
use App\Behaviour\PaypalPayment;

class ShopsController extends Controller {

	public function __construct(Guard $auth)
	{
		$this->middleware('auth', ['except' => ['index_home', 'show']]);
		$this->middleware('arma', ['except' => ['index_home', 'show']]);

		$this->auth = $auth;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = $this->auth->user();
		$shops = Shops::all();
		return view('admin.shops.index', compact('shops', 'user'));
	}

	public function index_home()
	{
		$shops = Shops::orderBy('id', 'DESC')->paginate(3);
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
				$paypal_store->id_arma = $request->user()->arma;
				$paypal_store->id_transaction = $transaction_id;
				$paypal_store->price = $shops->price;
				$paypal_store->save();


				DB::table('players')
					->where('playerid', $request->user()->arma)
					->update(array(
						'donatorlvl' => $shops->level
					));



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
		$user = $this->auth->user();
		$shops = new Shops();
		return view('admin.shops.create', compact('shops', 'user'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ShopsRequest $request)
	{
		Shops::create($request->only('name', 'time', 'content', 'price', 'image', 'level'));
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
		$user = $this->auth->user();
		$shops = Shops::findOrFail($id);
		return view('admin.shops.edit', compact('shops', 'user'));
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
		$shops->update($request->only('name', 'time', 'content', 'price', 'image', 'level'));
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
