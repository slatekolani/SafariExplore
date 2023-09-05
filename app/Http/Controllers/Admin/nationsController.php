<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nations\nations;
use App\Repositories\Admin\Nations\nationsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class nationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Nations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Nations.create');
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
            'nation_name'=>'required',
            'nation_flag'=>'required|mimes:jpg,png,jpeg|max:100',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $nationsRepo=new nationsRepository();
        $nations=$nationsRepo->storenation($input);
        return redirect()->route('nations.index')->with('nations',$nations)->withFlashSuccess('Nation submitted successfully');
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
    public function destroy(nations $nation)
    {
        $nation->delete();
        return redirect()->back()->withFlashSuccess('Nation removed successfully');
    }

    public function activateNation(Request $request)
    {
        $nation=nations::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $nation->status=1;
                break;
            case 1:
                $nation->status=0;
                break;
        }
        $nation->save();
    }
    public function getNations()
    {
        $nations=nations::query()->orderBy('nation_name')->get();
        return DataTables::of($nations)
            ->addColumn('nation_name',function ($nations){
                return $nations->nation_name;
            })
            ->addColumn('nation_flag',function ($nations){
                return $nations->nationFlagLabel;
            })
            ->addColumn('activate_nation',function ($nations){
                $btn='<label class="switch{{$nations->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('nation_status',function ($nations){
                return $nations->nation_status_label;
            })
            ->addColumn('actions',function ($nations){
                return $nations->buttonActionsLabel;
            })
            ->rawColumns(['actions','activate_nation','nation_status','nation_flag'])
            ->make(true);
    }
}
