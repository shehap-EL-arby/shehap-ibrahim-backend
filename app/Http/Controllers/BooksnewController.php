<?php

namespace App\Http\Controllers;

use App\Models\booksnew;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class BooksnewController extends Controller
{
    public function index()
    {
        $data=booksnew::latest()->get();
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
                 $validator["image"] = '/uploads/booksnew/'.$fileName;
                 $file->move(public_path('/uploads/booksnew'), $fileName);
                 booksnew::create($validator);
            return Response()->json(["data" => " data created success" , "status" => Response::HTTP_OK],Response::HTTP_OK);
    
    
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=booksnew::find($id);
        
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
    public function update(Request $request,  $id)
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
              $data=booksnew::find($id);
              if ($data!=null) {
                  $validator=$validator->validated();
                  $file=$request->file('image');
                  $fileName= time().'.'.$file->getClientOriginalExtension();
                  $validator["image"] = '/uploads/booksnew/'.$fileName;
                  $file->move(public_path('/uploads/booksnew'), $fileName);
                  booksnew::update($validator);
             return Response()->json(["data" => " data update" , "status" => Response::HTTP_NOT_FOUND],Response::HTTP_OK);
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
        $data=booksnew::find($id);
        if ($data!=null) {
            $data->delete();
            return Response()->json(["data" => "data delete success" , "status" => Response::HTTP_OK],Response::HTTP_OK);
        }
        else{
            return Response()->json(["data" => " THE RECORD NOT FOUND" , "status" => Response::HTTP_NOT_FOUND],Response::HTTP_OK);
        }
    }
}
