<?php

namespace App\Http\Controllers;
use App\Models\Connference;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conference = Conference::orderBy('id', 'fullname')->get();
        return response()->json($conference);
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
            'date_of_appoint' => 'required',
            'session' => 'required',
            'no_of_participantss' => 'required',
            'name_of_institution' => 'required'
       ]);
       if($validator->fails()){
        return $this->sendError('Error', $validator->errors());
       }
       $conference = Conference::create($input);
       return response()->json([
        'success' => true,
        'message' => 'Booked Successfully',
        'conference' => $conference
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
        return Conference::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     if(Conference::where('id', $id)->exists()){
    //         $conference = Conference::find($id);
    //         $conference->fullname = $request->fullname;
    //         $conference->address = $request->address;
    //         $conference->phoneno = $request->phoneno;
    //         $conference->date_of_appoint = $request->date_of_appoint;
    //         $conference->session = $request->session;
    //         $conference->no_of_participantss = $request->no_of_participantss;
    //         $conference->name_of_institution = $request->name_of_institution;
    //         $conference->save();
    //         return response()->json([
    //             'message' => 'Successfully Updated'
    //         ], 200);
    //     }
    //     else{
    //         return response()->json([
    //             'message' => 'Not Found'
    //         ], 404);
    //     }
       
    // }

    public function update(Request $request, $id)
    {
        $conference = Conference::findOrFail($id);
        if (!$conference) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'fullname' => 'required|max:50',
            'address' => 'required',
            'phoneno' => 'required',
            'date_of_appoint' => 'required',
            'session' => 'required',
            'no_of_participantss' => 'required',
            'name_of_institution' => 'required',
            // Add more fields to validate as needed
        ]);

        // Update the model with the new data
        $conference->fullname = $validatedData['fullname'];
        $conference->address = $validatedData['address'];
        $conference->phoneno = $validatedData['phoneno'];
        $conference->date_of_appoint = $validatedData['date_of_appoint'];
        $conference->session = $validatedData['session'];
        $conference->no_of_participantss = $validatedData['no_of_participantss'];
        $conference->name_of_institution = $validatedData['name_of_institution'];
        // Update more fields as needed
        $conference->save();

        return response()->json(['message' => 'Record updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->delete();
        return response()->json($conference);
    }
}
