<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourTypes\tourTypes;
use App\Repositories\Admin\TourTypes\tourTypesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use function foo\func;

class tourTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('TourType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TourType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'tour_type_name'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourTypeRepo=new tourTypesRepository();
        $tourType=$tourTypeRepo->storeTourType($input);
        return redirect()->route('tourType.index')->with('tourType',$tourType)->withFlashSuccess('Tour type saved successfully');
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
    public function destroy(tourTypes $tourType)
    {
        $tourType->delete();
        return back()->withFlashSuccess('Tour type removed successfully');
    }
    public function activateTourType(Request $request)
    {
        $tourType=tourTypes::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $tourType->status=1;
                break;
            case 1:
                $tourType->status=0;
                break;
        }
        $tourType->save();
    }
    public function getTourType()
    {
        $tourType=tourTypes::query()->orderBy('tour_type_name')->get();
        return DataTables::of($tourType)
            ->addColumn('tour_type_name',function ($tourType)
            {
                return $tourType->tour_type_name;
            })
            ->addColumn('activate_tour_type',function ($tourType)
            {
                $btn='<label class="switch{{$tourType->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('tourTypeStatus',function ($tourType)
            {
                return $tourType->tourTypeStatusLabel;
            })
            ->addColumn('actions',function ($tourType)
            {
                $btn='<a href="#" class="btn btn-primary btn-sm">Edit</a>';
                $btn=$btn.'<a href="'.route('tourType.delete',$tourType->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['tourTypeStatus','actions','activate_tour_type'])
            ->make(true);
    }
}
