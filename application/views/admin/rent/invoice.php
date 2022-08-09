<?php
$mobil = $rent->price * $rent->diff;
$sopir = 100000 * $rent->diff;
$total = $mobil + $sopir;

$this->load->library('Invoice');
$pdf = new Invoice();
$pdf->AddPage();
$pdf->SetFontSize(11);

// Info Faktur
$pdf->Text(140,20,'No. Faktur');
$pdf->Text(160,20,': ' . $rent->rent_id);
$pdf->Text(140,27,'Tanggal');
$pdf->Text(160,27,': ' . date_format(date_create($rent->paid_on), 'd-m-Y'));
$pdf->Text(140,34,'Pelanggan');
$pdf->Text(160,34,': ' . $rent->customer_name);

// Data Mobil Sewa
$pdf->SetLineWidth(0.7);
$pdf->Line(10, 49, 200, 49);
$pdf->SetLineWidth(0.2);
$pdf->Line(10, 50, 200, 50);
$pdf->SetY(50);
$pdf->Cell(17, 10, 'ID Mobil', 0, 0, 'C');
$pdf->Cell(30, 10, 'Nomor Polisi', 0, 0, 'C');
$pdf->Cell(30, 10, 'Biaya Sewa', 0, 0, 'C');
$pdf->Cell(30, 10, 'Tanggal Sewa', 0, 0, 'C');
$pdf->Cell(35, 10, 'Tanggal Kembali', 0, 0, 'C');
$pdf->Cell(0, 10, 'Pilihan', 0, 1, 'C');

$pdf->Line(10, 60, 200, 60);
$pdf->Cell(17, 10, $rent->vehicle_id, 0, 0, 'C');
$pdf->Cell(30, 10, $rent->license_plate, 0, 0, 'C');
$pdf->Cell(30, 10, 'Rp' . number_format($mobil,0,0,'.'), 0, 0, 'C');
$pdf->Cell(30, 10, date_format(date_create($rent->pickup_date), 'd-m-Y'), 0, 0, 'C');
$pdf->Cell(35, 10, date_format(date_create($rent->return_date), 'd-m-Y'), 0, 0, 'C');
$pdf->Cell(0, 10, 'Diambil ke garasi', 0, 1, 'C');

$pdf->Ln(5);
// Data Sopir
$pdf->SetLineWidth(0.7);
$pdf->Line(10, 74, 200, 74);
$pdf->SetLineWidth(0.2);
$pdf->Line(10, 75, 200, 75);
$pdf->Cell(17, 10, 'ID Sopir', 0, 0, 'C');
$pdf->Cell(30, 10, 'Nama Sopir', 0, 0, 'C');
$pdf->Cell(30, 10, 'Biaya Sopir', 0, 1, 'C');

$pdf->Line(10, 85, 200, 85);
$pdf->Cell(17, 10, $rent->driver_id, 0, 0, 'C');
$pdf->Cell(30, 10, ucwords($rent->name), 0, 0, 'C');
$pdf->Cell(30, 10, 'Rp' . number_format($sopir,0,0,'.'), 0, 1, 'C');

$pdf->Line(10, 95, 200, 95);
$pdf->SetFontSize(11);
$pdf->Ln(5);

// Total
$pdf->Text(110, 105, 'Total Biaya Sewa');
$pdf->Text(150, 105, 'Rp');
$pdf->Cell(0, 8, number_format($mobil,0,0,'.'), 0, 0,'R');

$pdf->Ln(7);
$pdf->Text(110, 112, 'Total Biaya Sopir');
$pdf->Text(150, 112, 'Rp');
$pdf->Cell(0, 8, number_format($sopir,0,0,'.'), 0, 0,'R');

$pdf->SetLineWidth(0.5);
$pdf->Line(150, 116, 200, 116);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->Text(110, 122, 'Grand Total');
$pdf->Text(150, 122, 'Rp');
$pdf->Cell(0, 8, number_format($total,0,0,'.'), 0, 0,'R');
$pdf->Output('I', 'invoice_'.$rent->rent_id.'.pdf');
