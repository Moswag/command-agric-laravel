<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Crop;
use Illuminate\Http\Request;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crops=Crop::all();
        return view('crop.view_crops',compact('crops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crop.add_crop');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Crop::where('name',$request->name)->exists()){
            return back()->with('error','Crop already exists, please change the name');
        }
        else{
            $crop=new Crop();
            $crop->name=$request->name;
            $crop->description=$request->description;
            $crop->yield=$request->yield;
            if($crop->save()){
                return redirect()->route('crop.index')->with('message','Crop successfully added');
            }
            else{
                return  back()->with('error','Failed to add crop, please contact admin');
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
        $crop=Crop::findOrFail($id);
        return view('crop.edit_crop', compact('crop'));
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
        $crop = Crop::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'yield' => 'required|numeric',
            'description' => 'required',
        ]);

        $input = $request->all();

        $crop->fill($input)->save();

        return redirect()->route('crop.index')->with('message','Crop successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Crop::find($id)->exists()){
            if(Crop::find($id)->delete()){
                return redirect()->route('crop.index')->with('message','Crop successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete crop, please contact admin');
            }
        }
        else{
            return back()->with('error','Failed to find crop id, please contact admin');
        }
    }
}
