<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Student::latest()->get();
        if ($data->isEmpty()) {
            return Response()->json(["data" => "there is on data" , "status" => Response::HTTP_NO_CONTENT ],Response::HTTP_OK);
        }
        else{
            return Response()->json(["data" => $data , "status" => Response::HTTP_OK ],Response::HTTP_OK);
        }
    }

   
    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $validator=Validator($request->all(), [
                "name"=>"required|string|max:255",
                "phone"=>"required|string|unique:students|max:255",
                "email"=>"required|string|unique:students|max:255",
            ]);
            if ($validator->fails()) {
                return Response()->json(["data" => $validator->errors() , "status" => Response::HTTP_UNPROCESSABLE_ENTITY],Response::HTTP_OK);
            }
            else{
                $validator=$validator->validated();
                $validator["last_contact"]=now();
                Student::create($validator);
                return Response()->json(["data" => " data created success" , "status" => Response::HTTP_OK],Response::HTTP_OK);
        
            }
        }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=Student::find($id);
        
        if ($data!=null) {
            return Response()->json(["data" => $data , "status" => Response::HTTP_OK],Response::HTTP_OK);
        }
        else{
            return Response()->json(["data" => " THE RECORD NOT FOUND" , "status" => Response::HTTP_NOT_FOUND],Response::HTTP_NOT_FOUND);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (is_null($id)) {
            return response()->json(["data" => "Invalid ID", "status" => Response::HTTP_BAD_REQUEST], Response::HTTP_OK);
        }
        $validator=Validator($request->all(), [
            "name"=>"required|string|max:255",
            "phone"=>"required|string|max:255",
            "email"=>"required|string|max:255",
           ]);
           if ($validator->fails()) {
            return Response()->json(["data" => $validator->errors() , "status" => Response::HTTP_UNPROCESSABLE_ENTITY],Response::HTTP_OK);
           }
           else{
             $data=Student::find($id);
             if ($data!=null) {
                 $validator=$validator->validated();
                 $data->update($validator); 
            return Response()->json(["data" => " data update" , "status" => Response::HTTP_OK],Response::HTTP_OK);
             }
             else{
            return Response()->json(["data" => " THE RECORD NOT FOUND" , "status" => Response::HTTP_NOT_FOUND],Response::HTTP_OK);

             }
           }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Student::find($id);
        if ($data!=null) {
            $data->delete();
            return Response()->json(["data" => "data delete success" , "status" => Response::HTTP_OK],Response::HTTP_OK);
        }
        else{
            return Response()->json(["data" => " THE RECORD NOT FOUND" , "status" => Response::HTTP_NOT_FOUND],Response::HTTP_OK);
        }
    }
}
    