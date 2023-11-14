<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Order;
use App\Models\User;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderInventoryController extends Controller
{
    public function index()
    {

        $title = 'Orders|CrazzyGift';
        $heading = "All Orders";

        return view('admin.OrdersView', compact('title', 'heading'));
    }

    public function getAllOrders()
    {
        $orders = Order::with('user')->orderBy('id', 'desc')->get();

        $ordersWithProductTitles = $orders->map(function ($order) {
            $products = json_decode($order->product_details, true);
            $productTitles = array_column($products, 'title');


            if (count($productTitles) > 1) {
                $numberedProductTitles = array_map(function ($key, $title) {
                    return ($key + 1) . ". " . $title;
                }, array_keys($productTitles), $productTitles);

                $productTitlesString = implode(', ', $numberedProductTitles);
            } else {
                $productTitlesString = implode(', ', $productTitles);
            }

            $order->products = $productTitlesString;
            return $order;
        });

        return response()->json($ordersWithProductTitles);
    }




    public function getFilterOrders(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $start_date = date('Y-m-d 00:00:00', strtotime($start_date));
        $end_date = date('Y-m-d 23:59:59', strtotime($end_date));

        $orders = Order::with('user')->whereBetween('created_at', [$start_date, $end_date])
            ->orderBy('created_at', 'desc')
            ->get();


        $ordersWithProductTitles = $orders->map(function ($order) {
            $products = json_decode($order->product_details, true);
            $productTitles = array_column($products, 'title');


            if (count($productTitles) > 1) {
                $numberedProductTitles = array_map(function ($key, $title) {
                    return ($key + 1) . ". " . $title;
                }, array_keys($productTitles), $productTitles);

                $productTitlesString = implode(', ', $numberedProductTitles);
            } else {
                $productTitlesString = implode(', ', $productTitles);
            }

            $order->products = $productTitlesString;
            return $order;
        });

        return response()->json($ordersWithProductTitles);
    }



    public function newOrders()
    {
        $title = 'Orders|CrazzyGift';
        $heading = "New Orders";

        return view('admin.NewOrdersView', compact('title', 'heading'));
    }

    public function getNewOrders()
    {
        // $orders = Order::all();

        $last30Days = now()->subDays(30);

        $orders = Order::with('user')->where('order_status', '!=', 0)
            ->where('created_at', '>=', $last30Days)
            ->get();


        $ordersWithProductTitles = $orders->map(function ($order) {
            $products = json_decode($order->product_details, true);
            $productTitles = array_column($products, 'title');


            if (count($productTitles) > 1) {
                $numberedProductTitles = array_map(function ($key, $title) {
                    return ($key + 1) . ". " . $title;
                }, array_keys($productTitles), $productTitles);

                $productTitlesString = implode(', ', $numberedProductTitles);
            } else {
                $productTitlesString = implode(', ', $productTitles);
            }

            $order->products = $productTitlesString;
            return $order;
        });

        return response()->json($ordersWithProductTitles);
    }

    public function cancelledOrders()
    {
        $title = 'Orders|CrazzyGift';
        $heading = "Cancelled Orders";

        return view('admin.CancelledOrdersView', compact('title', 'heading'));
    }

    public function getCancelledOrders()
    {
        //$orders = Order::all();

        $orders = Order::with('user')->where('order_status', 0)
            ->get();


        $ordersWithProductTitles = $orders->map(function ($order) {
            $products = json_decode($order->product_details, true);
            $productTitles = array_column($products, 'title');


            if (count($productTitles) > 1) {
                $numberedProductTitles = array_map(function ($key, $title) {
                    return ($key + 1) . ". " . $title;
                }, array_keys($productTitles), $productTitles);

                $productTitlesString = implode(', ', $numberedProductTitles);
            } else {
                $productTitlesString = implode(', ', $productTitles);
            }

            $order->products = $productTitlesString;
            return $order;
        });

        return response()->json($ordersWithProductTitles);
    }



    public function completedOrders()
    {
        $title = 'Orders|CrazzyGift';
        $heading = "Completed Orders";

        return view('admin.CompletedOrdersView', compact('title', 'heading'));
    }


    public function getCompletedOrders()
    {
        //$orders = Order::all();

        $orders = Order::with('user')->where('order_status', 5)
            ->get();


        $ordersWithProductTitles = $orders->map(function ($order) {
            $products = json_decode($order->product_details, true);
            $productTitles = array_column($products, 'title');


            if (count($productTitles) > 1) {
                $numberedProductTitles = array_map(function ($key, $title) {
                    return ($key + 1) . ". " . $title;
                }, array_keys($productTitles), $productTitles);

                $productTitlesString = implode(', ', $numberedProductTitles);
            } else {
                $productTitlesString = implode(', ', $productTitles);
            }

            $order->products = $productTitlesString;
            return $order;
        });

        return response()->json($ordersWithProductTitles);
    }

    public function orderDelete(Request $request)
    {
        if ($request->has('id')) {

            $orderId = $request->input('id');

            $res = Order::where('id', $orderId)->delete();

            if ($res) {
                return response()->json(['code' => 200, 'msg' => 'Order Deleted successfully'], 200);
            }
        }
    }


    public function orderDetails($order_id)
    {
        //var_dump($order_id);
        $title = 'Order Details|CrazzyGift';
        $order = Order::where(['id' => $order_id])->first();


        $customer = User::where('id', $order->user_id)->first();

        if ($order->awb) {
            // if awb number is not null
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://plapi.ecomexpress.in/track_me/api/mawbd/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('username' => 'HACREATIONSLLP914909', 'password' => 'UlewRODjHc', 'awb' => $order->awb),
                )
            );

            $response = curl_exec($curl);

            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($httpCode === 200) {
                $trackShipping = simplexml_load_string($response);
                if (count($trackShipping->object) > 0) {
                    $order->track_shipping = $trackShipping;
                } else {
                    $order->track_shipping = null;
                }
            }

            curl_close($curl);
        }

        //return view
        return view('admin.OrderDetails', compact('title', 'order', 'customer'));
    }

    public function orderReport(Request $request)
    {

        $title = 'Reports|CrazzyGift';
        $heading = "Order Report";

        $order['totalOrder'] = Order::count();
        $order['completedOrder'] = Order::where('order_status', 5)->count();
        $order['pendingOrder'] = Order::whereIn('order_status', [1, 2, 3, 4])->count();
        $order['cancelledOrder'] = Order::where('order_status', 0)->count();


        return view('admin.OrderReportView', compact('title', 'heading', 'order'));
    }
}
