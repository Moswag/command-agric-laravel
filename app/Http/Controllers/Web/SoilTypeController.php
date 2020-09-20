<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Crop;
use App\Models\SoilCrop;
use App\Models\SoilType;
use Illuminate\Http\Request;

class SoilTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soils = SoilType::all();
        $crops = Crop::all();
        return view('soil_type.view_soil_types', compact('soils', 'crops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $crops = Crop::all();
        return view('soil_type.add_soil_type', compact('crops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (SoilType::where('name', $request->name)->exists()) {
            return back()->with('error', 'Soil typre name already registered, please contact admin');
        } else {
            $soilType = new SoilType();
            $soilType->name = $request->name;
            $soilType->description = $request->description;

            if ($soilType->save()) {
                $crops = $request->crops;
                foreach ($crops as $crop) {
                    $soilCrop = new SoilCrop();
                    $soilCrop->soilTypeId = $soilType->id;
                    $soilCrop->cropId = $crop;
                    $soilCrop->save();
                }

                return redirect()->route('soil_type.index')->with('message', 'Soil type successfully added');

            } else {
                return back()->with('error', 'Failed to add soil type, please contact admin');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $soil = SoilType::findOrFail($id);
        $crops = SoilCrop::where('soilTypeId',$soil->id)->get();
        return view('soil_type.view_soil_type', compact('soil', 'crops'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $soil = SoilType::findOrFail($id);
        $crops = Crop::all();
        return view('soil_type.edit_soil_type', compact('soil', 'crops'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $soil = SoilType::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);


        $input = $request->all();

        $soil->fill($input)->save();
        $soilCrops = SoilCrop::where('soilTypeId', $id)->get();
        foreach ($soilCrops as $soil) {
            SoilCrop::findOrFail($soil->id)->delete();
        }

        $crops = $request->crops;
        foreach ($crops as $crop) {
            $soilCrop = new SoilCrop();
            $soilCrop->soilTypeId = $id;
            $soilCrop->cropId = $crop;
            $soilCrop->save();
        }

        return redirect()->route('soil_type.index')->with('message', 'Soil type successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
