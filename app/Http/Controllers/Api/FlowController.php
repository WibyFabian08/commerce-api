<?php

namespace App\Http\Controllers\Api;

use App\Models\Flow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlowController extends Controller
{
    public function getFlow(Request $request) {
        // $flow = Flow::find(1);
        $flow = Flow::with("content")->where([["device_id", $request->device_id], ["keyword", $request->keyword]])->get();

        if(count($flow) > 0) {
            return response()->json([
                "success" => true,
                "message" => "get flow success",
                "data" => $flow[0]
            ]);

        } else {
            return response()->json([
                "success" => true,
                "message" => "get flow success",
                "data" => null,
            ]);
        }
    }

    public function getFlows(Request $request) {
        // $flow = Flow::find(1);
        $flow = Flow::with("content")->where([["device_id", $request->device_id]])->get();

        if(count($flow) > 0) {
            return response()->json([
                "success" => true,
                "message" => "get flow success",
                "data" => $flow
            ]);

        } else {
            return response()->json([
                "success" => true,
                "message" => "get flow success",
                "data" => null,
            ]);
        }
    }

    public function create(Request $request) {

        return response()->json([
            "success" => true,
            "message" => "create flow success"
        ]);
    }
}
