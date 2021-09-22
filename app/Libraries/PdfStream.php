<?php
namespace App\Libraries;

use Dompdf\Dompdf;

class PdfStream {

    public function stream($html, $type) {
        $pdf = new Dompdf();
        $pdf->getOptions()->setChroot(FCPATH);
        $pdf->loadHtml($html);
        $pdf->setPaper('letter', 'portrait');
        $pdf->render();
        $pdf->stream($this->getRandomName($type), ["Attachment" => 0]);
    }

    private function getRandomName($type) {
		return $type . '_'  . time() . '_'  . bin2hex(random_bytes(16)) . '.pdf';
	}

}
