<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderDetailController extends Controller
{
    public function create(Request $request) {
        $data = $request->all();

        $rules = [
            "order_id" => "required",
            "total" => "required",
            "product_id" => "required",
            "product_name" => "required",
            "quantity" => "required",
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ]);
        }

        $order = OrderDetail::create($data);

        return response()->json([
            "success" => true,
            "message" => "Create order success",
            "data" => $order
        ]);
    }
}

