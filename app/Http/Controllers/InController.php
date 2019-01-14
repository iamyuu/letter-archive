<?php

namespace App\Http\Controllers;

use DB;
use Crypt;
use App\File;
use App\Role;
use App\Letter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function code()
    {
        // \Auth::id() == 2 ?: abort(403);
        $no = Letter::orderBy('id', 'desc')->select(\DB::raw('RIGHT(id, 2) as no'))->orderBy('no', 'desc')->first();
        return response()->json($no);
    }

    public function index()
    {
        // \Auth::id() == 1 || \Auth::id() == 2 ?: abort(403);
    	$letters = Letter::orderBy('id', 'asc')->get();
        $roles = Role::where([['id', '!=', 1], ['id', '!=', 2], ['id', '!=', 3]])->get();
    	return view('letter.in', compact('letters', 'roles'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // \Auth::id() == 2 ?: abort(403);
        $this->validate($request, [
            'code' => 'required|string',
            'from' => 'nullable|string',
            'to'   => 'nullable|string',
            'subject' => 'required|string',
            'content' => 'required|string',
            'incoming' => 'required|string',
            'files'    => 'nullable|max:2048|mimes:pdf,png,jpg',
        ]);

        // dd($request->all());
        if (!empty($request->files)) {
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $filenya = Storage::put('public', $file);

                File::create([
                    'name' => $file->getClientOriginalName(),
                    'file' => $filenya,
                    'mail_id' => $request->id
                ]);
            }
        }

        $date = Carbon::now()->format('Y-m-d');
        if ($request->incoming > $date) {
            return redirect()->back()->withErrors('The letter from future');
        } else {
            if ($request->in_out == 1) {
                DB::table('mail')->insert([
                    'id' => $request->id,
                    'incoming_at' => $request->incoming,
                    'mail_code'   => $request->code,
                    'mail_from'   => $request->from,
                    'mail_subject' => $request->subject,
                    'mail_content' => $request->content,
                    'in_out' => $request->in_out
                ]);
            } else {
                DB::table('mail')->insert([
                    'id' => $request->id,
                    'incoming_at' => $request->incoming,
                    'mail_code'   => $request->code,
                    'mail_to'     => $request->to,
                    'mail_subject' => $request->subject,
                    'mail_content' => $request->content,
                    'in_out' => $request->in_out
                ]);
            }
        }

        session()->flash('success'. 'Success archived');
    	return redirect()->to('arsip-surat');
    }

    public function show($id)
    {
        \Auth::id() == 2 ?: abort(403);
        $id = Crypt::decrypt($id);
        $letter = Letter::find($id);
        $files  = File::where('mail_id', $id)->get();
    	return view('letter.single', compact('letter', 'files'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|string',
            'from' => 'nullable|string',
            'to'   => 'nullable|string',
            'subject' => 'required|string',
            'content' => 'required|string',
            'incoming' => 'required|string',
            // 'files'    => 'nullable|max:2048|mimes:pdf,png,jpg',
        ]);

        if (!empty($request->files)) {
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $filenya = Storage::put('public', $file);

                File::create([
                    'name' => $file->getClientOriginalName(),
                    'file' => $filenya,
                    'mail_id' => $request->id
                ]);
            }
        }

        $date = Carbon::now()->format('Y-m-d');
        if ($request->incoming > $date) {
            return redirect()->back()->withErrors('The letter from future');
        } else {
            if ($request->in_out == 1) {
                DB::table('mail')->insert([
                    'id' => $request->id,
                    'incoming_at' => $request->incoming,
                    'mail_code'   => $request->code,
                    'mail_from'   => $request->from,
                    'mail_subject' => $request->subject,
                    'mail_content' => $request->content,
                    'in_out' => $request->in_out
                ]);
            } else {
                DB::table('mail')->insert([
                    'id' => $request->id,
                    'incoming_at' => $request->incoming,
                    'mail_code'   => $request->code,
                    'mail_to'     => $request->to,
                    'mail_subject' => $request->subject,
                    'mail_content' => $request->content,
                    'in_out' => $request->in_out
                ]);
            }
            return 'add mail';
        }

        session()->flash('success'. 'Success archived');
        return redirect()->to('arsip-surat');
    }
}
