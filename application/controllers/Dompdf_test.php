<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dompdf_test extends CI_Controller
{

	/**
	 * Example: DOMPDF 
	 *
	 * Documentation: 
	 * http://code.google.com/p/dompdf/wiki/Usage
	 *
	 */
	public function index()
	{

		$data['alumni'] = $this->Admin_model->data_alumni();
		// Load all views as normal
		$this->load->view('admin/export_pdf_alumni', $data);
		// Get output html
		$html = $this->output->get_output();

		// Load library
		$this->load->library('dompdf_gen');

		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("welcome.pdf");
	}
}
