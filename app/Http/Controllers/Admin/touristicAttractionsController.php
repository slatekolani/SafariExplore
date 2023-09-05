<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Repositories\Admin\TouristicAttraction\touristicAttractionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class touristicAttractionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('TouristAttraction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TouristAttraction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attraction_name' => 'required',
            'attraction_description' => 'required',
            'attraction_category' => 'required',
            'GPS_url' => 'required|url',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input = $request->all();
        $touristicAttractionRepo=new touristicAttractionRepository();
        $touristicAttraction=$touristicAttractionRepo->storeTouristicAttractions($input);
        return redirect()->route('touristicAttractions.index')->with('touristicAttraction',$touristicAttraction)->withFlashSuccess('Touristic attraction submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(touristicAttractions $touristicAttraction)
    {
        $touristicAttraction->delete();
        return back()->withFlashSuccess('Touristic attraction removed successfully');
    }

    public function activateAttraction(Request $request)
    {
        $touristAttraction=touristicAttractions::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $touristAttraction->status=1;
                break;
            case 1:
                $touristAttraction->status=0;
                break;
        }
        $touristAttraction->save();
    }
    public function getTouristicAttractions()
    {
        $touristicAttractions=touristicAttractions::query()->orderBy('attraction_name')->get();
        return DataTables::of($touristicAttractions)
            ->addColumn('attraction_name',function ($touristicAttractions){
                return $touristicAttractions->attraction_name;
            })
            ->addColumn('attraction_description',function ($touristicAttractions){
                return $touristicAttractions->attraction_description;
            })
            ->addColumn('attraction_category',function ($touristicAttractions){
                return $touristicAttractions->attraction_category;
            })
            ->addColumn('GPS_url',function ($touristicAttractions){
                return $touristicAttractions->GPS_url;
            })

            ->addColumn('activate_attraction',function($touristicAttractions){
                $btn='<label class="switch{{$touristicAttractions->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('attraction_status',function ($touristicAttractions){
                return $touristicAttractions->attraction_status_label;
            })
            ->addColumn('actions',function ($touristicAttractions){
                return $touristicAttractions->button_action_label;
            })
            ->rawColumns(['attraction_status','actions','activate_attraction'])
            ->make(true);
    }
}
