<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Farm;
use App\Models\SystemConstants;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $farms=Farm::all();
        return view('farm.view_farms',compact('farms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts=District::all();
        return view('farm.add_farm', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Farm::where('farmNumber',$request->farmNumber)->exists()){
            return back()->with('error','Farm already exits');
        }
        else{
            $farm  = new Farm();
            $farm->farmNumber=$request->farmNumber;
            $farm->hectares= $request->hectares;
            $farm->districtId=$request->districtId;
            $farm->status=SystemConstants::FARM_STATUS_VACANT;

            if($farm->save()){
                return redirect()->route('farm.index')->with('message', 'Farm successfully added');
            }
            else{
                return back()->with('error','Failed to add farm, please contact admin');
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
        $farm=Farm::findOrFail($id);
        $districts=District::all();
        return view('farm.edit_farm', compact('farm', 'districts'));
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
        $farm = Farm::findOrFail($id);
        $this->validate($request, [
            'farmNumber' => 'required',
            'hectares' => 'required|numeric',
            'districtId' => 'required',
        ]);


        $input = $request->all();

        $farm->fill($input)->save();

        return redirect()->route('farm.index')->with('message', 'Farm successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Farm::find($id)->exists()){
            if(Farm::find($id)->delete()){
                return redirect()->route('farm.index')->with('message','Farm successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete farm');
            }
        }
        else{
            return back()->with('error','Failed to delete farm because the Farm Id do not exist');
        }
    }
}
