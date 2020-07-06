<?php

namespace App\Http\Controllers;

use App\Submission;
use App\Letter;
use Illuminate\Http\Request;
use Activity;

class SubmissionController extends Controller
{
    public function store($letter, Request $request)
    {
        $letter = Letter::find($letter);

    	$submission = New Submission;
    	$submission->user_id = auth()->id();
    	$submission->letter_id = $letter->id;
    	$submission->data = json_encode($request->except('_token'));
    	$submission->approval_status = 0;
    	$submission->save();

    	Activity::add(['page' => 'Pengajuan Surat', 'description' => 'Mengajukan Surat Baru: ' . $letter->name]);

        return back()->with([
            'status' => 'success', 
            'message' => 'Berhasil Mengajukan Surat! Silahkan Tunggu Petugas Untuk Kerumah Anda.'
        ]);
    }
}
