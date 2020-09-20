<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\District;
use App\Models\Farm;
use App\Models\Farmer;
use App\Models\SystemConstants;
use App\Models\User;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributions=Distribution::all();
        return view('distribution.view_distribution',compact('distributions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts=District::all();
        return view('distribution.add_distribution',compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $distribuion =new Distribution();
        $distribuion->district=$request->districtId;
        $distribuion->date=$request->date;
        $distribuion->status=SystemConstants::STATUS_PENDING;

        if($distribuion->save()){
            $farms=Farm::where('districtId',$request->districtId)->get();
            foreach ($farms as $farm){
                $farmer=Farmer::where('farmId',$farm->id)->get()->first();
                $user=User::find($farmer->userId);
                //send message
                $username = 'wmoswa';
                // Webservices token for above Webservice username
                $token = '69cc641235f76f1eb376128d9cdf2bc5';

                // BulkSMS Webservices URL
                $bulksms_ws = 'http://portal.bulksmsweb.com/index.php?app=ws';

                // destination numbers, comma seperated or use #groupcode for sending to group
                // $destinations = '#devteam,263071077072,26370229338';
                // $destinations = '26300123123123,26300456456456';  for multiple recipients
                $destinations = $farmer->phoneNumber;

                // SMS Message to send
                $message = 'Hello '.$user->name.' '.$user->surname.' Please note that we will be distributing farm inputs on '.$request->date.'. Regards';

                // send via BulkSMS HTTP API

                $ws_str = $bulksms_ws . '&u=' . $username . '&h=' . $token . '&op=pv';
                $ws_str .= '&to=' . urlencode($destinations) . '&msg='.urlencode($message);
                $ws_response = @file_get_contents($ws_str);

               // echo $ws_response;
            }

            return redirect()->route('distribution.index')->with('message','Distribution notification successfully send');
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
        $distribution=Distribution::findOrFail($id);
        $districts=District::all();
        return view('distribution.edit_distribution',compact('distribution','districts'));
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
        $distribution = Distribution::findOrFail($id);

        $this->validate($request, [
            'district' => 'required',
            'date' => 'required',
        ]);

        $input = $request->all();
        $distribution->fill($input)->save();
        return redirect()->route('distribution.index')->with('message', 'Distribution successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distribution = Distribution::findOrFail($id)->delete();
        if($distribution){
            return redirect()->route('distribution.index')->with('message', 'Distribution successfully deleted');
        }
    }
}
