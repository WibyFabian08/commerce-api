<?php

namespace App\Http\Controllers\Api;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function index(Request $request) {
        return response()->json([
            "success" => true,
            "message" => "get content sucess"
        ]);
    }

    public function findById(Request $request, $id) {

        $data = Content::find($id);

        if($data == null) {
            return response()->json([
                "success" => false,
                "message" => "data not found"
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Get content success",
            "data" => $data
        ]);
    }

    public function create(Request $request) {

        $data = $request->all();

        $rules = [
            "content" => "string|required",
            "type" => "string|required"
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ]);
        }

        $content = Content::create($data);

        return response()->json([
            "success" => true,
            "message" => "Create content success",
            "data" => $content
        ]);
    }
}
