<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

class Pdf extends Dompdf\Dompdf
{
	/**
	 * Get an instance of CodeIgniter
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function ci()
	{
		return get_instance();
	}

	/**
	 * Load a CodeIgniter view into domPDF
	 *
	 * @access	public
	 * @param	string	$view The view to load
	 * @param	array	$data The view data
	 * @return	void
	 */
	public function load_view($view, $data = array(),$nomor, $paper, $orientation)
	{
		$html = $this->ci()->load->view($view, $data, TRUE);
		// $loadci = $this->ci();
		// $html = $loadci->load->view($view, $data, TRUE);
		$this->load_html($html);
		$this->setPaper($paper, $orientation);
		$this->render();
		$this->stream($nomor . ".pdf" , array("Attachment" => false));
	}
}
