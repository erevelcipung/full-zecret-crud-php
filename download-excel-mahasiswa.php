<?php

session_start();

//membatasai halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Silahkan Login terlebih dahulu!');
            document.location.href = 'login.php';
        </script>";

    exit;
}

//membatasai halaman sesuai user yang login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3 ) {
    echo "<script>
            alert('Perhatian anda tidak punya hak akses!');
            document.location.href = 'crud-modal.php';
        </script>";

    exit;
}

require 'config/app.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Nama');
$sheet->setCellValue('C2', 'Program Studi');
$sheet->setCellValue('D2', 'Jenis Kelamin');
$sheet->setCellValue('E2', 'Telepon');
$sheet->setCellValue('F2', 'Email');
$sheet->setCellValue('G2', 'Foto');

$data_mahasiswa = select("SELECT * FROM mahasiswa");

$no = 1;
$start = 3;

foreach ($data_mahasiswa as $mahasiswa) {
    $sheet->setCellValue('A'.$start, $no++)                 ->getColumnDimension('A')->setAutoSize(true);
    $sheet->setCellValue('B'.$start, $mahasiswa ['nama'])   ->getColumnDimension('B')->setAutoSize(true);
    $sheet->setCellValue('C'.$start, $mahasiswa ['prodi'])  ->getColumnDimension('C')->setAutoSize(true);
    $sheet->setCellValue('D'.$start, $mahasiswa ['jk'])     ->getColumnDimension('D')->setAutoSize(true);
    $sheet->setCellValue('E'.$start, $mahasiswa ['telepon'])->getColumnDimension('E')->setAutoSize(true);
    $sheet->setCellValue('F'.$start, $mahasiswa ['email'])  ->getColumnDimension('F')->setAutoSize(true);
    $sheet->setCellValue('G'.$start, 'http://localhost/zecret_crud/assets/images/'. $mahasiswa['foto'])->getColumnDimension('G')->setAutoSize(true);

    $start++;

}

//border table
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$border = $start - 1;
$sheet->getStyle('A2:G'.$border)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('laporan-mahasiswa-2000.xlsx');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet.sheet');
header('Content-Disposition: attachment; filename="laporan-mahasiswa-200.xlsx"');
readfile('laporan-mahasiswa-2000.xlsx');
unlink('laporan-mahasiswa-2000.xlsx');
exit;

?>