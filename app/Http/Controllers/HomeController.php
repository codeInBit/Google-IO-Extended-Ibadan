<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all order created and Form to create new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $today = date('Y-m-d');
//        $oldDate = date('Y-m-d', strtotime ('-6 day')) ;
//        $datesBetween = getDatesBetween($oldDate, $today);

        if(Auth::user()->isAdmin()){
//            if($request->search == "all"){
//                $orders = Order::paginate(10);
//            }elseif($request->search == "seven"){
//                $orders = Order::whereBetween('created_at', '$datesBetween')->paginate(10);
//            }elseif($request->search == "today"){
//                $orders = Order::whereDate('created_at', $today)->paginate(10);
//            }else{
                $orders = Order::paginate(10);
//            }
        }else{
//            if($request->search == "all"){
//                $orders = Order::where('madeBy', Auth::User()->name)->paginate(10);
//            }elseif($request->search == "seven"){
//                $orders = Order::where('madeBy', Auth::User()->name)->paginate(10);
//            }elseif($request->search == "today"){
//                $orders = Order::where('madeBy', Auth::User()->name)->paginate(10);
//            }else{
                $orders = Order::where('madeBy', Auth::User()->name)->paginate(10);
//            }
        }

        if(Auth::user()->isAdmin()){
            $users = User::all();
        }
        $products = Product::get(['productType']);
        return view('home', compact('products', 'users', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created oder in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $createOrder = new Order();

        //Validate incoming HTTP request (Form inputs)
        $this->validate($request, [
            'quantity' => 'required',
        ]);
        $newOrder = $request->all();

        if(Auth::user()->isAdmin()){
            $createOrder->madeBy = $newOrder['madeBy'];
        }else{
            $createOrder->madeby = Auth::User()->name;
        }
        $createOrder->product = $newOrder['product'];
        $createOrder->quantity = $newOrder['quantity'];
        $createOrder->save();
        return redirect("/home")->with('status', 'Your order was successfully created!');
    }

    /*
         * View data
         */
    public function view(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = Order::find($id);
            //echo json_decode($info);
            return response()->json($info);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Validate incoming HTTP request (Form inputs)
        $this->validate($request, [
            'quantity' => 'required',
        ]);

        $id = $request['edit_id'];
        $order = Order::find($id);
        $updateOder = $request->all();
        if(Auth::user()->isAdmin()){
            $order->madeBy = $updateOder['madeBy'];
        }
        $order->product = $updateOder['product'];
        $order->quantity = $updateOder['quantity'];
        $order->update();
        return redirect('/home')->with('update', 'Order was successfully updated!');

    }

    /**
     * Remove the specified order from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delApp = Order::find($id);
        $delApp->delete();
        return redirect('/home')->with('delete', 'Order was successfully deleted!');
    }
}
