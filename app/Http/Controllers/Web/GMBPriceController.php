<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Crop;
use App\Models\GMBPrice;
use Illuminate\Http\Request;

class GMBPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices=GMBPrice::all();
        return view('gmb.view_prices',compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $crops=Crop::all();
        return view('gmb.add_price',compact('crops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(GMBPrice::where('cropId',$request->cropId)->exists()){
            return back()->with('error','GMB price already exists');
        }
        else{
            $crop=Crop::find($request->cropId);
            $price=new GMBPrice();
            $price->cropId=$crop->id;
            $price->crop=$crop->name;
            $price->price=$request->price;
            $price->unit='KG';

            if($price->save()){
                return redirect()->route('gmb.index')->with('message','Crop successfully added');
            }
            else{
                return back()->with('error'.'Failed to add crop, please contact admin');
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
        $gmb=GMBPrice::findOrFail($id);
        $crop=Crop::findOrFail($gmb->cropId);
        return view('gmb.edit_price',compact('gmb','crop'));
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
        $price = GMBPrice::findOrFail($id);

        $this->validate($request, [
            'cropId' => 'required',
            'price' => 'required|numeric',
        ]);

        $input = $request->all();

        $price->fill($input)->save();

        return redirect()->route('gmb.index')->with('message','GMB Price successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(GMBPrice::find($id)->exists()){
            if(GMBPrice::find($id)->delete()){
                return redirect()->route('gmb.index')->with('message','Price successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete, please contact admin');
            }
        }
    }
}
