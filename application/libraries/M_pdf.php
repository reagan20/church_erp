<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once("vendor/autoload.php");

class M_pdf {

    public $param;
    public $pdf;

    public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    {
        $this->param =$param;
       // $this->pdf = new mPDF($this->param);
        $this->pdf = $this->pdf= new \Mpdf\Mpdf(array(
            'mode' => '',
            'format' => 'A4',
            'default_font_size' => 0,
            'default_font' => '',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'orientation' => 'P'
        ));
    }
}