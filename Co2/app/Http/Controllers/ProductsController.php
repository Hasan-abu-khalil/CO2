<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Products::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" class="edit btn btn-primary btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="javascript:void(0)" class="deleteProduct btn btn-danger btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Delete">
                        <i class="fas fa-trash"></i>
                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view("Admin.Products.product");
    }




    public function store(Request $request)
    {
        $product = new Products([
            'name' => $request->name,
            'unit' => $request->unit,
        ]);
        $product->save();
        return response()->json(['success' => 'Product saved successfully']);
    }




    public function edit($id)
    {
        $product = Products::find($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Products::find($id);
        $product->name = $request->name;
        $product->unit = $request->unit;
        $product->save();
        return response()->json(['success' => 'Product updated successfully']);
    }


    public function destroy($id)
    {
        Products::find($id)->delete();
        return response()->json(['success' => 'Product deleted successfully']);

    }
}
