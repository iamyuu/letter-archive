<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Crypt;
use App\File;
use App\Role;
use App\Letter;
use App\Forward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OtherController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function check(Request $request)
    {
    	$roles = Role::where([['id', '!=', 1], ['id', '!=', 2], ['id', '!=', 3]])->get();
    	$forwards = Forward::where('mail_id', $request->id)->get();;
    	return view('_modal-forward', compact('forwards'))->withRoles($roles)->withId($request->id);
    }

    public function forward(Request $request)
    {
    	for ($i = 0; $i < count($request->to); $i++) {
            Forward::create([
                'description' => $request->description,
                'status'      => $request->status,
                'mail_id'     => $request->id,
                'user_id'     => $request->to[$i]
            ]);
        }

    	return redirect()->to('arsip-surat')->with('success', 'Letter Success Disposition');
    }

    public function print($id)
    {
        $mail_id = Crypt::decrypt($id);
        $letter = Letter::find($mail_id);
        return view('letter.print', compact('letter'));
    }

    public function inbox()
    {
        \Auth::id() > 2 ?: abort(403);
        $letters = Forward::with('mail')->where('user_id', Auth::id())->orderBy('disposition_at')->get();
        return view('inbox', compact('letters'));
    }

    public function read($id)
    {
        \Auth::id() > 2 ?: abort(403);
        $mail_id = Crypt::decrypt($id);
        $files  = File::where('mail_id', $mail_id);
        $letter = Letter::find($mail_id);
        Forward::where('mail_id', $mail_id)->update(['read_unread' => '1']);
        return view('letter.single', compact('letter', 'files'));
    }

    public function count()
    {
        $count = Forward::where(['read_unread' => '0', 'user_id' => Auth::id()])->count();
        return response()->json($count);
    }

    public function report()
    {
        $letter = Letter::orderBy('id', 'asc')->get();
    	return view('report', compact('letter'));
    }

    public function filter(Request $request)
    {
    	$year  = $request->year;
    	$month = $request->month;
    	$first = '';
    	$last  = '';
        $type  = $request->type;

        if ($month == 2) {
            $first = '01';
            $last  = '28';
        } elseif ($month == 7) {
            $first = '01';
            $last  = '31';
        } elseif ($month == 8) {
            $first = '01';
            $last  = '31';
        } else {
        	for ($i = 0; $i < $request->month; $i++) {
        		if ($i % 2 == 0) {
        			$first = '01';
        			$last  = '31';
        		} elseif ($i % 2 == 1) {
        			$first = '01';
        			$last  = '30';
        		}
        	}
        }

        if ($request->type == 1) {
            $letter = Letter::whereBetween('incoming_at', ["$year-$month-$first", "$year-$month-$last"])->get();
        } else {
            $letter = Letter::where('in_out', $type)->whereBetween('incoming_at', ["$year-$month-$first", "$year-$month-$last"])->get();
        }

        // dd($letter);
        if (!$letter->isEmpty()) {
         //    if ($to == 1) {
                // $pdf = PDF::setPaper('A4')->loadView('cetak', compact('letter'));
                // return $pdf->stream();
        	// } elseif ($to == 2) {
        		return view('cetak', compact('letter'));
        	// }
        } else {
            // return redirect()->to('laporan')->withErrors('Data does not exist');
        }
    }

    // public function loadInbox()
    // {
    //     $letters = Forward::with('mail')->where('user_id', Auth::id())->orderBy('disposition_at')->get();
    //     $output  = '';
    //     foreach ($letters as $letter) {
    //         if ($letter->read_unread == 0) {
    //             $output .= '<tr style="background-color: #eee;">';
    //         } else {
    //             $output .= '<tr>';
    //         }
    //             $output .=
    //                         "<td>{{ str_limit($letter->mail->mail_subject, 25) }}</td>".
    //                         "<td>" .
    //                         '<a href=".'url("detail-surat", Crypt::encrypt($letter->mail->id))'.">'.
    //                             str_limit($letter->mail->mail_content, 115).
    //                         "</a>".
    //                         "</td>".
    //                         "<td>{{ $letter->mail->mail_date->format('d, M Y') }}</td>".
    //                     "</tr>";
    //     }

    //     return response()->json($output);
    // }
}