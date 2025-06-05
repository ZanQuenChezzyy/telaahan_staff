<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelaahanStaff;
use Barryvdh\DomPDF\Facade\PDF;

class PdfController extends Controller
{
    public function print($id)
    {
        $telaahanStaff = TelaahanStaff::with(['permintaanBarang', 'pemeliharaan', 'lainnya', 'lampiran'])
            ->where('id', $id)
            ->firstOrFail();

        // Convert lampiran to Base64
        foreach ($telaahanStaff->lampiran as $lampiran) {
            $path = storage_path('app/public/' . $lampiran->nama_file);
            if (file_exists($path)) {
                $lampiran->base64 = 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path));
            } else {
                $lampiran->base64 = null; // If file not found
            }
        }

        $fileName = "telaahan_staff_" . preg_replace('/[\/\\\?<>|":*]/', '-', $telaahanStaff->nomor) . ".pdf";

        $pdf = PDF::loadView('pdf.telaahan_staff', compact('telaahanStaff'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream($fileName);
    }
}
