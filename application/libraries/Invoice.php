<?php
require('fpdf/fpdf.php');

class Invoice extends FPDF {
	function Header()
	{
		// Judul
		$this->SetFont('Arial','',24);
		$this->Text(10,20,'Rental Mobil');
		
		// Info
		$this->SetFontSize(10);
		$this->Text(10,30, 'Jalan Merpati Putih No. 7');
		$this->Text(10,35, '08123456789');
		$this->Text(10,40, 'rental@merpati.com');
		$this->Text(10,45, 'www.rentalmerpati.com');
	}
}
