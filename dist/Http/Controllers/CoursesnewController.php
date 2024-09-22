<?php

namespace App\Http\Controllers;

use App\Models\coursesnew;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class CoursesnewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=coursesnew::latest()->get();
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
            "title"=>'required|unique:courses|max:255',
            "description"=>'required|string',
            'image' => 'nullable|file|mimes:jpg,bmp,png',
            'price' => 'required|numeric|min:0'
        
        ]);
        if ($validator->fails()) {
            return Response()->json(["data" => $validator->errors() , "status" => Response::HTTP_UNPROCESSABLE_ENTITY],Response::HTTP_OK);
        }
        else{
            $validator=$validator->validated();
                 $file=$request->file('image');
                 $fileName= time().'.'.$file->getClientOriginalExtension();
                 $validator["image"] = '/uploads/coursesnew/'.$fileName;
                 $file->move(public_path('/uploads/coursesnew'), $fileName);
                 coursesnew::create($validator);
            return Response()->json(["data" => " data created success" , "status" => Response::HTTP_OK],Response::HTTP_OK);
    
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=coursesnew::find($id);

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
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255', 
            'description' => 'required|string',
            'image' => 'nullable|file|mimes:jpg,bmp,png',
            'price' => 'required|numeric|min:0'
        ]);
    
        
        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY
            ], Response::HTTP_OK);
        }
    
        
        $data = coursesnew::find($id);
        if ($data !== null) {
            $validatedData = $validator->validated();
    
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time().'.'.$file->getClientOriginalExtension();
                $validatedData['image'] = '/uploads/coursesnew/'.$fileName;
                $file->move(public_path('/uploads/coursesnew'), $fileName);
            }
    
          
            $data->update($validatedData);
    
            return response()->json([
                'data' => 'Data updated successfully',
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
    
       
        return response()->json([
            'data' => 'The record not found',
            'status' => Response::HTTP_NOT_FOUND
        ], Response::HTTP_OK);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=coursesnew::find($id);
        if ($data!=null) {
            $data->delete();
            return Response()->json(["data" => "data delete success" , "status" => Response::HTTP_OK],Response::HTTP_OK);
        }
        else{
            return Response()->json(["data" => " THE RECORD NOT FOUND" , "status" => Response::HTTP_NOT_FOUND],Response::HTTP_OK);
        }
    }
}
