<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CompanyUserController extends Controller
{
    protected $role;
    protected $company;

    public function __construct()
    {
        $this->role = Gate::allows('SA');
        $this->company = Auth::user()->company;
    }
    public function index(Request $request)
    {
        $key = $request->key;
        $value = $request->value;
        $orderBy = $request->orderBy ?? 'id';
        $orderType = $request->orderType ?? 'desc';


        $records = User::whereRole('CA')->when(!$this->role, function ($q) {
            return $q->whereCompany($this->company);
        })->when($key, function ($query) use ($key, $value) {
            return $query->where($key, "LIKE", "%$value%");
        })->orderBy($orderBy, $orderType)->paginate($request->limit ?? env('STANDARD_PAGINATION'));
        return view('admin.company_user.index', compact('records', 'key', 'value', 'orderBy', 'orderType'));
    }

    public function create(Request $request)
    {
        $company = $request->company;
        $companies  = Company::when(!$this->role, function ($q) {
            return $q->whereId($this->company);
        })->where('is_active', 1)->get(['id', 'name', 'image']);
        return view('admin.company_user.create', compact('companies', 'company'));
    }
    public function edit(Request $request, $company_slug, $id)
    {
        $company = $request->company;
        $companies  = Company::when(!$this->role, function ($q) {
            return $q->whereId($this->company);
        })->where('is_active', 1)->get(['id', 'name', 'image']);
        $data = User::whereRole('CA')->when(!$this->role, function ($q) {
            return $q->whereCompany($this->company);
        })->findOrFail($id);
        return view('admin.company_user.create', compact('data', 'companies', 'company'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email' . ($request->id ? ("," . $request->id) : ''),
            'image' => 'nullable|file|mimes:jpg,png,jpeg,gif|max:2048',
        ];
        if (!$request->id) {
            $rules['password'] = 'required';
        }

        $validator  = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 443, 'msg' => $validator->errors()]);
        }

        $data = $request->except('_token');
        $old = null;
        if ($request->id) {
            $old = User::whereRole('CA')->findOrFail($request->id);
        }
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('company_user', 'public');
            if ($old) {
                if ($old->image_exist) {
                    unlink($old->image_path);
                }
            }
        }
        $data['role'] = 'CA';
        if (!$data['password']) {
            unset($data['password']);
        }
        if (!$this->role) {
            $data['company'] = $this->company;
        }
        if ($old) {
            $old->update($data);
        } else {
            User::create($data);
        }

        return response()->json(['status' => 200, 'msg' => "Successfully " . ($request->id ? 'Updated' : 'Created') . " !"]);
    }

    public function updates(Request $request)
    {
        $data = User::whereRole('CA')->when(!$this->role, function ($q) {
            return $q->whereCompany($this->company);
        })->findOrFail($request->id);
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
        $data = User::whereRole('CA')->when(!$this->role, function ($q) {
            return $q->whereCompany($this->company);
        })->findOrFail($request->id);
        if ($data->image_exist) {
            unlink($data->image_path);
        }
        $data->delete();
        return redirect()->back()->with('success', 'Deleted!');
    }
    public function deleteAll(Request $request)
    {
        $data = User::whereRole('CA')->when(!$this->role, function ($q) {
            return $q->whereCompany($this->company);
        })->whereIn('id', explode(",", $request->ids ?? ''));
        foreach ($data->get('image') as $item) {
            if ($item->image_exist) {
                unlink($item->image_path);
            }
        }
        $data->delete();
        return redirect()->back()->with('success', "Selected Items Deleted!");
    }
}
