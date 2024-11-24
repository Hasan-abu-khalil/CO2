<?php

namespace App\Http\Controllers;

use App\Models\Co2;
use App\Models\Percentages;
use App\Models\Products;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Co2Controller extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Eager load percentage and product data
            $data = Co2::with(['percentage', 'product'])->select('co2s.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('percentage_amount', function ($row) {
                    // Access the percentage amount from the related percentage model
                    return $row->percentage ? $row->percentage->amount : 'N/A';
                })
                ->addColumn('product_name', function ($row) {
                    return $row->product ? $row->product->name : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <a href="javascript:void(0)" class="edit btn btn-primary btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="javascript:void(0)" class="deleteCo2 btn btn-danger btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Delete">
                        <i class="fas fa-trash"></i>
                    </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Fetch CO2 data for chart
        $co2Data = Co2::select('amount', 'product_id')
            ->with('product')
            ->get()
            ->groupBy('product.name')
            ->map(function ($data) {
                return $data->sum('amount');
            })
            ->toArray();

        $percentages = Percentages::all();
        $products = Products::all();

        return view('Admin.Co2.Co2', compact('percentages', 'products', 'co2Data'));
    }




    public function store(Request $request)
    {
        $co2 = new Co2([
            'amount' => $request->amount,
            'unit' => $request->unit,
            'percentage_id' => $request->percentage_id,
            'product_id' => $request->product_id,

        ]);

        $co2->save();
        return response()->json(['success' => 'Co2 added successfully']);
    }



    public function edit($id)
    {
        $co2 = Co2::find($id);
        return response()->json($co2);
    }

    public function update(Request $request, $id)
    {
        $co2 = Percentages::find($id);
        $co2->amount = $request->amount;
        $co2->unit = $request->unit;
        $co2->percentage_id = $request->percentage_id;
        $co2->product_id = $request->product_id;
        $co2->save();
        return response()->json(['success' => 'Co2 updated successfully']);
    }


    public function destroy($id)
    {
        Co2::find($id)->delete();
        return response()->json(['success' => 'Co2 deleted successfully']);

    }

}
