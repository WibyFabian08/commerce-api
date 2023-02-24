<?php

namespace App\Http\Controllers\Api;

use App\Models\Flow;
use App\Models\Outlet;
use App\Models\PhoneState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OutletController extends Controller
{
    public function index(Request $request) {
        $outlet = Outlet::all();

        if(count($outlet) > 1) {
            $rows = [
                "title" => "List Outlet",
                "rows" => []
            ];
            $section = [];
    
            foreach($outlet as $data) {
                array_push($rows["rows"], [
                    "title" => $data["name"],
                    "rowId" => "outlet_id@{$data['id']}@catalog"
                ]);
            }
    
            array_push($section, $rows);
    
            $listMessage = [
                "text" => "Silahkan pilih outlet sesuai tempat tinggal anda",
                "footer" => "Amanda Brownies",
                "title" => "List Outlet",
                "buttonText" => "Pilih Satu",
                "sections" => $section
            ];

            return response()->json([
                "status" => true,
                "content" => $listMessage,
            ]);
        } else {
            $flow = Flow::with("content")->where([["keyword", "catalog"]])->get();

            return response()->json([
                "status" => true,
                "content" => json_decode($flow[0]->content["content"]),
            ]);
        }
        
    }

    public function create(Request $request) {
        $data = $request->all();
        $rules = [
            "device_id" => "required|integer", 
            "name" => "required|string", 
            "address" => "required|string", 
            "phone" => "required|min:11|max:12", 
            "email" => "required|email"
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return response()->json([
                "success" => true,
                "data" => $validator->errors()
            ]);
        }

        $outlet = Outlet::create($data);

        return response()->json([
            "success" => true,
            "message" => "Create Outlet Success",
            "data" => $outlet
        ]);
    }

    public function update(Request $request, $id) {
        $outlet = Outlet::find($id);

        if($outlet == null) {
            return response()->json([
                "success" => true,
                "message" => "data not found",
                "data" => null
            ]);
        }
        $data = $request->all();

        $rules = [
            "device_id" => "required|integer", 
            "name" => "required|string", 
            "address" => "required|string", 
            "phone" => "required|min:11|max:12", 
            "email" => "required|email"
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ]);
        }

        $outlet->update($data);

        return response()->json([
            "success" => true,
            "message" => "Update Outlet Success",
            "data" => $outlet
        ]);
    }

    public function delete(Request $request, $id) {
        $outlet = Outlet::find($id);

        if($outlet == null) {
            return response()->json([
                "success" => true,
                "message" => "data not found",
                "data" => null
            ]);
        }
        
        $outlet->delete();

        return response()->json([
            "success" => true,
            "message" => "Delete Outlet Success",
        ]);
    }
}
