<?php

namespace App\Http\Controllers\Api;

use App\Models\Outlet;
use App\Models\OrderTemp;
use App\Models\PhoneState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhoneStateController extends Controller
{
    public function create(Request $request) {
        $orderTemp = OrderTemp::where("phone", $request->phone)->get();

        $checkState = PhoneState::where("phone", $request->phone)->get();

        $outlet = Outlet::where("device_id", $request->device_id)->get();

        if(count($checkState) < 1) {
            $phoneState = PhoneState::create([
                "phone" => $request->phone,
                "state" => "initial",
                "type_state" => "initial"
            ]);

            if(count($orderTemp) < 1) {
                OrderTemp::create([
                    "phone" => $request->phone,
                    "outlet_id" => $outlet[0]->id
                ]);
            }

            return response()->json([
                "success" => true,
                "message" => "create state success",
                "data" => $phoneState,
            ]);
        } else {
            if(count($orderTemp) > 0) {
                $orderData = OrderTemp::find($orderTemp[0]->id);

                if($request->tempData && $orderData) {
                    foreach ($request->tempData as $key => $value) {
                        $orderData->update([
                            $key => $request->tempData[$key]
                        ]);
                    }
                }
            }

            $stateData = PhoneState::find($checkState[0]->id);

            $stateData->update([
                "phone" => $request->phone,
                "state" => $request->state,
                "type_state" => $request->type_state
            ]);

            return response()->json([
                "success" => true,
                "message" => "update state success",
                "data" => $stateData
            ]);
        }
    }

    public function get(Request $request) {
        $checkState = PhoneState::where("phone", $request->phone)->get();

        if(count($checkState) < 1) {
            return response()->json([
                "success" => true,
                "message" => "get state success",
                "data" => null,
                "phone" => $request->phone
            ]);
        } else {
            return response()->json([
                "success" => true,
                "message" => "get state success",
                "data" => $checkState[0]
            ]);
        }
    }

    public function delete(Request $request, $phone) {
        PhoneState::where("phone", $phone)->delete();
        OrderTemp::where("phone", $phone)->delete();

        return response()->json([
            "success" => true,
            "message" => "Delete State Success",
        ]);
    }
}
