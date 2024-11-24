<?php

namespace App\Http\Controllers;


use App\Models\TotalConsumption;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TotalConsumptionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TotalConsumption::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" class="edit btn btn-primary btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="javascript:void(0)" class="deleteTotalConsumption btn btn-danger btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Delete">
                        <i class="fas fa-trash"></i>
                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view("Admin.TotalConsumption.TotalConsumption");
    }


    public function store(Request $request)
    {
        $source = new TotalConsumption([
            'q1' => $request->q1,
            'q2' => $request->q2,
            'q3' => $request->q3,
            'q4' => $request->q4,

        ]);

        $source->save();
        return response()->json(['success' => 'Total Consumption added successfully']);
    }


    public function edit($id)
    {
        $co2 = TotalConsumption::find($id);
        return response()->json($co2);
    }

    public function update(Request $request, $id)
    {
        $co2 = TotalConsumption::find($id);
        $co2->q1 = $request->q1;
        $co2->q2 = $request->q2;
        $co2->q3 = $request->q3;
        $co2->q4 = $request->q4;
        $co2->save();
        return response()->json(['success' => 'Total Consumption updated successfully']);
    }


    public function destroy($id)
    {
        TotalConsumption::find($id)->delete();
        return response()->json(['success' => 'Total Consumption deleted successfully']);

    }
}
