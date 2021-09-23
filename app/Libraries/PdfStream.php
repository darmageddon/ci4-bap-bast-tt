<?php
namespace App\Libraries;

use Dompdf\Dompdf;

class PdfStream {

    public function stream($html, $filename) {
        $pdf = new Dompdf();
        $pdf->getOptions()->setChroot(FCPATH);
        $pdf->loadHtml($html);
        $pdf->setPaper('letter', 'portrait');
        $pdf->render();
        $pdf->stream($filename, ["Attachment" => 0]);
    }
}
