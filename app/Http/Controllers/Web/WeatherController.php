<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Farm;
use App\Models\Farmer;
use App\Models\User;
use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weathers=Weather::all();
        return view('weather.view_weathers',compact('weathers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts=District::all();
        return view('weather.add_weather', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $weather=new Weather();
        $weather->notification=$request->notification;
        $weather->district=$request->district;

        if($weather->save()){
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
                $message = 'Hello '.$user->name.' '.$user->surname.'. '.$request->notification.'. Regards';

                // send via BulkSMS HTTP API

                $ws_str = $bulksms_ws . '&u=' . $username . '&h=' . $token . '&op=pv';
                $ws_str .= '&to=' . urlencode($destinations) . '&msg='.urlencode($message);
                $ws_response = @file_get_contents($ws_str);

                // echo $ws_response;
            }
            return redirect()->route('weather.index')->with('message','Weather notification successfully added');
        }
        else{
            return back()->with('error','Failed to save weather notification, please contact admin');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Weather::find($id)->exists()){
            if(Weather::find($id)->delete()){
                return redirect()->route('weather.index')->with('message','Weather notification successfully deleted');
            }
            else{
                return back()->with('error','Failed to delete notification');
            }
        }
    }
}
