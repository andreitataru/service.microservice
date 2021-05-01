<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function addService(Request $request) {  
        //validate incoming request 
        $this->validate($request, [
            'providerId' => 'required',
            'name' => 'required',
            'location' => 'required',
            'priceHour' => 'required',
            'serviceType' => 'required',
            'description' => 'required',
            'minHourDay' => 'required',
            'maxHourDay' => 'required'
        ]);
        
        try {
            $service = new Service;
            $service->providerId = $request->providerId;
            $service->name = $request->name;
            $service->location = $request->location;
            $service->priceHour = $request->priceHour;
            $service->serviceType = $request->serviceType;
            $service->description = $request->description;
            $service->minHourDay = $request->minHourDay;
            $service->maxHourDay = $request->maxHourDay;

            $service->save();
           
            //return successful response
            return response()->json(['service' => $service, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'addService Failed' + $e], 409);
        }


    }

}
