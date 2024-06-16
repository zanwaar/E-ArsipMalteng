<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Disposition;
use App\Models\Letter;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    public function index(Request $request)
    {

        // $Disposition = Disposition::where('penerima',auth()->user()->id)->get();
        $Disposition = Disposition::with(['user', 'status', 'letter'])
            ->where('penerima', auth()->user()->id)
            ->get();

        $responseData = $Disposition->map(function ($disposisi) {
            // $surat = Attachment::where('dokument_id', $disposisi->dokumet->id)
            // ->get();
            return [
                'id' => $disposisi->id,
                'letter' => $disposisi->letter->id,
                'type' => $disposisi->letter->type,
                'file' => $disposisi->letter->attachments,
                'nomor_agenda' => $disposisi->letter->nomor_agenda,
                'nomor_dokument' => $disposisi->letter->nomor_dokument,
                'formatted_tgl_dokument' => $disposisi->letter->formatted_tgl_dokument,
                'formatted_tgl_dokument' => $disposisi->letter->formatted_tgl_dokument,
                'penerima' => auth()->user()->name,
                'formatted_batas_waktu' => $disposisi->formatted_batas_waktu,
                'content' => $disposisi->content,
                'note' => $disposisi->note,
                'status' => $disposisi->status->status,
            ];
        });
        return response()->json($responseData);
    }
}
