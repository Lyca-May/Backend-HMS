<?php

namespace App\Http\Controllers;
use App\Models\Visit;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visits = Visit::orderBy('id', 'fullname')->get();
        return response()->json($visits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $input = $request->all();
       $validator = Validator::make($input,[
            'fullname' => 'required',
            'address' => 'required',
            'phoneno' => 'required',
            'date_of_visit' => 'required',
            'session' => 'required',
            'no_of_visitors' => 'required',
            'name_of_institution' => 'required',
            'status' => 'required',
            'reason' => 'required',
       ]);
       if($validator->fails()){
        return $this->sendError('Error', $validator->errors());
       }
       $visits = Visit::create($input);
       return response()->json([
        'success' => true,
        'message' => 'Booked Successfully',
        'visits' => $visits
       ]);
    }

 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Visit::find($id);
    }


    public function update(Request $request, $id)
    {
        $conference = Visit::findOrFail($id);
        if (!$conference) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'fullname' => 'required|max:50',
            'address' => 'required',
            'phoneno' => 'required',
            'date_of_visit' => 'required',
            'session' => 'required',
            'no_of_visitors' => 'required',
            'name_of_institution' => 'required',
            'status' => 'required',
            'reason' => 'required',
            // Add more fields to validate as needed
        ]);

        // Update the model with the new data
        $conference->fullname = $validatedData['fullname'];
        $conference->address = $validatedData['address'];
        $conference->phoneno = $validatedData['phoneno'];
        $conference->date_of_visit = $validatedData['date_of_visit'];
        $conference->session = $validatedData['session'];
        $conference->no_of_visitors = $validatedData['no_of_visitors'];
        $conference->name_of_institution = $validatedData['name_of_institution'];
        $conference->status = $validatedData['status'];
        $conference->reason = $validatedData['reason'];
        // Update more fields as needed
        $conference->save();

        return response()->json(['message' => 'Record updated successfully'], 200);
    }

    public function updateStatus(Request $request, $id)
{
    $conference = Visit::findOrFail($id);
        if (!$conference) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
           'status' => 'required'
            // Add more fields to validate as needed
        ]);

        // Update the model with the new data
       
        $conference->status = $validatedData['status'];
        // Update more fields as needed
        $conference->save();

        return response()->json(['message' => 'status updated successfully'], 200);
}

public function addReason(Request $request, $id)
{
    $conference = Visit::findOrFail($id);
        if (!$conference) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
           'reason' => 'required',
           'status' => 'required'
            // Add more fields to validate as needed
        ]);

        // Update the model with the new data
       
        $conference->status = $validatedData['status'];
        $conference->reason = $validatedData['reason'];
        // Update more fields as needed
        $conference->save();

        return response()->json(['message' => 'successfully Cancelled'], 200);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visits = Visit::findOrFail($id);
        $visits->delete();
        return response()->json($visits);
    }
}
