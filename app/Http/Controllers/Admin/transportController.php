<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transport\transport;
use App\Repositories\Transport\transportRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class transportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Transport.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Transport.create');
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
            'transport_name'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $transportRepo=new transportRepository();
        $transport=$transportRepo->storeTransport($input);
        return redirect()->route('transports.index')->with('transport',$transport)->withFlashSuccess('Transport saved successfully');
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
    public function destroy(transport $transport)
    {
        $transport->delete();
        return back()->withFlashSuccess('Transport deleted successfully');
    }

    public function activateTransport(Request $request)
    {
        $transport=transport::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $transport->status=1;
                break;
            case 1:
                $transport->status=0;
                break;
        }
        $transport->save();
    }
    public function getTransports()
    {
        $transport=transport::query()->orderBy('transport_name')->get();
        return DataTables::of($transport)
            ->addColumn('transport_name',function ($transport){
                return $transport->transport_name;
            })
            ->addColumn('activate_transport',function ($transport){
                $btn='<label class="switch{{$transport->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('transport_status',function ($transport){
                return $transport->transportStatusLabel;
            })
            ->addColumn('actions',function ($transport){
                $btn='<a href="#" class="btn btn-primary btn-sm">Edit</a>';
                $btn=$btn.'<a href="'.route('transports.delete',$transport->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['activate_transport','transport_status','actions'])
            ->make(true);
    }
}
