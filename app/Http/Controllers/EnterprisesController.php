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
    
}
