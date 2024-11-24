<?php

namespace App\Http\Controllers;

use App\Models\Sources;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SourcesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sources::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" class="edit btn btn-primary btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="javascript:void(0)" class="deleteSource btn btn-danger btn-action" data-id="' . $row->id . '" data-toggle="tooltip" title="Delete">
                        <i class="fas fa-trash"></i>
                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view("Admin.Sources.source");
    }


    public function edit($id)
    {
        $source = Sources::find($id);
        return response()->json($source);
    }

    public function update(Request $request, $id)
    {
        $source = Sources::find($id);
        $source->name = $request->name;
        $source->save();
        return response()->json(['success' => 'Source updated successfully']);
    }



    public function store(Request $request)
    {
        $source = new Sources([
            'name' => $request->name,
        ]);

        $source->save();
        return response()->json(['success' => 'Source added successfully']);
    }

    public function destroy($id)
    {
        Sources::find($id)->delete();
        return response()->json(['success' => 'Source deleted successfully']);

    }

}

