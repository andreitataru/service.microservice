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

    public function getAllServices(Request $request){
        return response()->json(['houses' =>  Service::all()], 200);
    }

    public function getServiceById($id)
    {
        try {
            $service = Service::findOrFail($id);

            return response()->json(['service' => $service], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'Service not found!'], 404);
        }

    }

    public function updateService(Request $request){ //recebe id do Service
        $service = Service::where('id' , '=' , $request->serviceId)->first();

        //so altera o que receber no request (filled)
        if ($request->filled('name')){
            $service->name = $request->name;
        }
        if ($request->filled('location')){
            $service->location = $request->location;
        }
        if ($request->filled('priceHour')){
            $service->priceHour = $request->priceHour;
        }
        if ($request->filled('serviceType')){
            $service->serviceType = $request->serviceType;
        }
        if ($request->filled('description')){
            $service->description = $request->description;
        }
        if ($request->filled('minHourDay')){
            $service->minHourDay = $request->minHourDay;
        }
        if ($request->filled('maxHourDay')){
            $service->maxHourDay = $request->maxHourDay;
        }
    
        if(!$service->save()) {
            throw new HttpException(500);
        }
        else {
            return response()->json([
                'status' => 'Service Updated'
            ], 200);
        }
    }

    public function deleteServiceById($id)
    {
        $service = Service::findOrFail($id);

        if(!$service->delete()) {
            throw new HttpException(500);
        }
        else {
            return response()->json([
                'status' => 'Service deleted'
            ], 200);
        }
    }

    public function getServicesWithFilter(Request $request)
    {
        $services = Service::all();

        if ($request->filled('providerId')){
            $services = $services->where('providerId', $request->providerId);
        }
        if ($request->filled('name')){
            $services = $services->where('name', $request->name);
        }
        if ($request->filled('location')){
            $services = $services->where('location', $request->location);
        }
        if ($request->filled('priceHour')){
            $services = $services->where('priceHour', '<=', $request->priceHour);
        }
        if ($request->filled('serviceType')){
            $services = $services->where('serviceType', $request->serviceType);
        }
        if ($request->filled('description')){
            $services = $services->where('description', $request->description);
        }
        if ($request->filled('rating')){
            $services = $services->where('rating', '<=', $request->rating);
        }
        if ($request->filled('minHourDay')){
            $services = $services->where('minHourDay', '<=', $request->minHourDay);
        }
        if ($request->filled('maxHourDay')){
            $services = $services->where('maxHourDay', '<=', $request->maxHourDay);
        }

        return $services;
    }

}
