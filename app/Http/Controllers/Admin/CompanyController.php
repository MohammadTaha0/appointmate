<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->key;
        $value = $request->value;
        $orderBy = $request->orderBy ?? 'id';
        $orderType = $request->orderType ?? 'desc';
        $records = Company::when($key, function ($query) use ($key, $value) {
            return $query->where($key, "LIKE", "%$value%");
        })->orderBy($orderBy, $orderType)->paginate($request->limit ?? env('STANDARD_PAGINATION'));
        return view('admin.company.index', compact('records', 'key', 'value', 'orderBy', 'orderType'));
    }

    public function create()
    {
        return view('admin.company.create');
    }
    public function edit($company_slug, $id)
    {
        $data = Company::findOrFail($id);
        return view('admin.company.create', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:companies,name' . ($request->id ? ("," . $request->id) : ''),
            'image' => 'nullable|file|mimes:jpg,png,jpeg,gif|max:2048',
        ];

        $validator  = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 443, 'msg' => $validator->errors()]);
        }

        $data = $request->except('_token');
        $old = null;
        if ($request->id) {
            $old = Company::findOrFail($request->id);
        }
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('company', 'public');
            if ($old) {
                if ($old->image_exist) {
                    unlink($old->image_path);
                }
            }
        }
        if ($old) {
            $old->update($data);
        } else {
            Company::create($data);
        }

        return response()->json(['status' => 200, 'msg' => "Successfully " . ($request->id ? 'Updated' : 'Created') . " !"]);
    }

    public function updates(Request $request)
    {
        $data = Company::findOrFail($request->id);
        $statuses = [
            'is_active' => [
                '1' => '0',
                '0' => '1',
            ]
        ];
        // return $statuses[$request->type][$request->status];
        $data->update([$request->type => $statuses[$request->type][$request->status]]);

        return response()->json(['status' => 200, 'msg' => 'Successfully Updated', 'html' => $data->{"{$request->type}_name_badge"}]);
    }
    public function delete(Request $request)
    {
        $data = Company::findOrFail($request->id);
        if ($data->image_exist) {
            unlink($data->image_path);
        }
        $data->delete();
        return redirect()->back()->with('success', 'Deleted!');
    }
    public function deleteAll(Request $request)
    {
        $data = Company::whereIn('id', explode(",", $request->ids ?? ''));
        foreach ($data->get('image') as $item) {
            if ($item->image_exist) {
                unlink($item->image_path);
            }
        }
        $data->delete();
        return redirect()->back()->with('success', "Selected Items Deleted!");
    }
}
