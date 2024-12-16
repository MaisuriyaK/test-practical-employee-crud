<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use DataTables;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Employee::select('*');

            return Datatables::of($data)

                    ->addIndexColumn()
                    ->addColumn('photo', function($row){

                        $url = $row->photo !=null ? asset('photos/'.$row->photo) : null;
                        return $url !=null ? '<img src="'.$url.'" class="img-thumbnail" width="100" height="150">' : 'N/A';
 
                 })
                    ->addColumn('action', function($row){

                           $btn = '<a href="employee/'.$row->id.'/edit" class="edit btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>';
                           $btn .= '<a href="javascript:void(0)" class="edit btn btn-danger btn-sm deleteEmployee" data-id="'.$row->id.'"><i class="bi bi-trash"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action','photo'])
                    ->make(true);
        }
        return view('employee.list');

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        if($request->hasFile('images')) {
                $input['images']=time().'.'.$request->images->extension();
                $request->images->move(public_path('photos'), $input['images']);
                $request['photo'] = $input['images'] == 'undefined' ? null : $input['images'];     
        }
        $request['hobby']=implode(',', $request->hobby);
        Employee::create($request->all());

        return response()->json([ 'type'=>'success','message'=>'Employee created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee=Employee::find($id);
        return view('employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        if($request->hasFile('images')) {
            $input['images']=time().'.'.$request->images->extension();
            $request->images->move(public_path('photos'), $input['images']);
            $request['photo'] =  $input['images'];
            $imagePath='/photos/'.$request->photo;
            if(file_exists($imagePath)) {
                unlink($imagePath);
            }
        }else{
            $request['photo'] = $employee->photo;
        }

        $request['hobby']=implode(',', $request->hobby);

        $employee->update($request->all());

    
    return redirect()->route('employee.index')->with('success','Employee updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::find($id)->delete();
        return response()->json([ 'type'=>'success','message'=>'Employee deleted successfully.']);
    }
}
