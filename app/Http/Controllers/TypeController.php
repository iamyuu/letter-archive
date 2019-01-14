<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$types = Type::orderBy('type', 'asc')->get();
    	return view('type', compact('types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|string|unique:mail_type',
        ]);

        Type::create(['type' => $request->type]);

    	return redirect()->to('tipe-surat')->with('success', 'Letter Archived');
    }

    public function update(Request $request)
    {
        return $request->all();
    }

    public function delete($id)
    {
        return $id;
    }
}
