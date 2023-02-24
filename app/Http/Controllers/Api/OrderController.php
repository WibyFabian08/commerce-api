<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderTemp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create(Request $request) {
        $orderTemp = OrderTemp::where("phone", $request->phone)->first();
        $data = $request->all();

        $rules = [
            "phone" => "required",
            "order_id" => "required",
            "item_count" => "required",
            "status" => "required",
            "token" => "required",
            "total" => "required",
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ]);
        }

        $order = Order::create([
            "phone" => $request->phone,
            "order_id" => $request->order_id,
            "item_count" => $request->item_count,
            "status" => $request->status,
            "token" => $request->token,
            "total" => $request->total,
            "outlet_id" => $orderTemp->outlet_id,
            "delivery_location" => $orderTemp->location !== null ? $orderTemp->location : "take-away",
        ]);

        return response()->json([
            "success" => true,
            "message" => "Create order success",
            "data" => $order
        ]);
    }
}
