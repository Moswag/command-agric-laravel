<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Crop;
use App\Models\District;
use App\Models\SoilCrop;
use App\Models\SoilType;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts=District::all();
        return view('district.view_districts', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $soils=SoilType::all();
        return view('district.add_district', compact('soils'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(District::where('name',$request->name)->exists()){
            return back()->with('error','District already exist');
        }
        else{
            $district=new District();
            $district->name=$request->name;
            $district->chief=$request->chief;
            $district->soilTypeId=$request->soilTypeId;

            if($district->save()){
                return redirect()->route('district.index')->with('message','District successfully added');
            }
            else{
                return back()->with('error','Failed to register district, please contact admin');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $soils = SoilType::all();
        $district = District::findOrFail($id);
        return view('district.edit_district', compact('soils', 'district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $district = District::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'chief' => 'required',
            'soilTypeId' => 'required',
        ]);


        $input = $request->all();

        $district->fill($input)->save();

        return redirect()->route('district.index')->with('message', 'District successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(District::find($id)->exists()){
            if(District::find($id)->delete()){
                return redirect()->route('district.index')->with('message','District successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete district, please contact admin');
            }
        }
        else{
            return back()->with('error','Failed to delete district because the district Id do not exist');
        }
    }
}
