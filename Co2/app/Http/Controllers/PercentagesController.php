<?php

namespace App\Http\Controllers;

use App\Models\Percentages;
use App\Models\Products;
use App\Models\Sources;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PercentagesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Percentages::with(['source', 'product'])
                ->select('percentages.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('source_name', function ($row) {
                    return $row->source->name ?? 'N/A';
                })
                ->addColumn('product_name', function ($row) {
                    return $row->product->name ?? 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" class="edit btn btn-primary btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="javascript:void(0)" class="deletePercentage btn btn-danger btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Delete">
                        <i class="fas fa-trash"></i>
                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $sources = Sources::all();
        $products = Products::all();

        return view('Admin.percentages.percentage', compact('sources', 'products'));
    }


    public function store(Request $request)
    {
        $percentage = new Percentages([
            'amount' => $request->amount,
            'source_id' => $request->source_id,
            'product_id' => $request->product_id,

        ]);

        $percentage->save();
        return response()->json(['success' => 'percentage added successfully']);
    }


    public function edit($id)
    {
        $percentage = Percentages::find($id);
        return response()->json($percentage);
    }

    public function update(Request $request, $id)
    {
        $percentage = Percentages::find($id);
        $percentage->amount = $request->amount;
        $percentage->source_id = $request->source_id;
        $percentage->product_id = $request->product_id;
        $percentage->save();
        return response()->json(['success' => 'percentage updated successfully']);
    }

    public function destroy($id)
    {
        Percentages::find($id)->delete();
        return response()->json(['success' => 'Percentages deleted successfully']);

    }
}
