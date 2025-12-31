<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class EnterprisesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required|max:13',
            'code' => 'required|unique:enterprises,code'
        ]);

        $enterprise = Enterprise::create($request->only(
            'name',
            'email',
            'phone',
            'code'
        ));

        return response()->json($enterprise, 200);

    }

    public function update(Request $request)
    {
        $request->validate([
            'ent_id' => 'required|exists:enterprises,id',
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required|max:13',
            'code' => 'required|unique:enterprises,code,' . $request->ent_id
        ]);

        $enterprise = Enterprise::findOrFail($request->ent_id);

        $enterprise->name = $request->name;
        $enterprise->email = $request->email;
        $enterprise->phone = $request->phone;
        $enterprise->code = $request->code;
        $enterprise->save();

        return response()->json([
            'msg' => 'Enterprise updated successfully'
        ], 200);

    }

    public function updateEnterpriseStatus(Request $request)
    {

        $request->validate([
            "ent_id" => 'required',
            "status" => 'required'
        ]);

        $enterprise = Enterprise::findOrFail($request->ent_id);

        $enterprise->status = $request->status;
        $enterprise->save();

        return response()->json([
            'msg' => 'Enterprise status updated successfully'
        ], 200);

    }

}
