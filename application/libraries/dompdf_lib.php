<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class Dompdf_lib
{
    protected $CI;
    protected $dompdf;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->dompdf = new Dompdf();
    }

    public function generatePDF($html, $filename='', $output = 'stream')
    {
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();

        if ($output == 'stream') {
            $this->dompdf->stream($filename . '.pdf', array('Attachment' => 0));
        } elseif ($output == 'download') {
            $this->dompdf->stream($filename . '.pdf', array('Attachment' => 1));
        }
    }
}
