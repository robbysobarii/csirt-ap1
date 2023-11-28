<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class RfcPdfController extends Controller
{
    public function showRfcPdf($filename)
    {
        $path = public_path("file/{$filename}");

        if (!file_exists($path)) {
            abort(404, 'PDF file not found');
        }

        $response = response()->stream(
            function () use ($path) {
                $stream = fopen($path, 'rb');
                fpassthru($stream);
                fclose($stream);
            },
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]
        );

        return $response;
    }
}
