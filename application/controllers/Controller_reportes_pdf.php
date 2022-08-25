<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH."/libraries/PHPExcel/Classes/PHPExcel.php";
class Controller_reportes_pdf extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Modelo_crud');
		$this->load->helper('funciones_helper');

		date_default_timezone_set('America/La_Paz');
	}
	public function index(){
		redirect(base_url().'login');
	}

	public function reportePdf(){
		// $obj=$this->Modelo_administracion->editarCurso($idcursos_tecnico);
		ob_start();
		require_once APPPATH."/libraries/fpdf/fpdf.php"; 
		$pdf = new FPDF('P','mm','A4',true);
		$pdf->AddPage();
		$pdf->SetLeftMargin(10);
		$pdf->SetAutoPageBreak(1, 20);

		$pdf->SetAuthor('JC');

		$title='BOLETA DE AFILIADOS-'.date('Ymd_Hs');
		$pdf->SetTitle($title);

		$pdf->Image("assets/logos.jpg",15,10,20,25,"jpg");

		$pdf->ln(10);

		$pdf->SetFillColor(241,250,203);
		$pdf->SetDrawColor(0,100,102);

		$pdf->SetTextColor(0,100,102); 
		$pdf->setFont('Times', 'B', 24);
   		$pdf->Cell(198,7,'LISTA DE ESTUDIANTES',0,1,'C');
   		$pdf->setFont('Times', '', 8);
   		$pdf->Cell(198,1,'======================================================================',0,1,'C');
   		// $pdf->Line(10,35,205,35);
   		$pdf->ln(8);

   		$pdf->setFont('Times', 'B', 9);
   		$pdf->Cell(10,7,'#',1,0,'C',1);
   		$pdf->Cell(16,7,'CARNET',1,0,'C',1);
   		$pdf->Cell(40,7,'NOMBRE',1,0,'C',1);
   		$pdf->Cell(50,7,'APELLIDOS',1,0,'C',1);
   		$pdf->Cell(18,7,'CELULAR',1,0,'C',1);
   		$pdf->Cell(30,7,'ESTADO',1,0,'C',1);
   		$pdf->Cell(30,7,'ROL',1,1,'C',1);
   		$con=1; 
        foreach ($this->Modelo_crud->listar_usuarios() as $value) {
	   		$pdf->setFont('Arial', '', 6);
	   		$pdf->Cell(10,6,$con++,1,0,'C',1);
	   		$pdf->Cell(16,6,$value->ci.' '.$value->expedido,1,0,'C');
	   		$pdf->Cell(40,6,$value->nombre,1,0,'C');
	   		$pdf->Cell(50,6,$value->paterno.' '.$value->materno,1,0,'C');
	   		$pdf->Cell(18,6,$value->celular,1,0,'C');
	   		$pdf->Cell(30,6,$value->estado,1,0,'C');
	   		$pdf->Cell(30,6,$value->roles,1,1,'C');
   		}
   		$pdf->Output($title.'.pdf','I');
   		ob_end_clean();	
		
	}
	public function reporteExcel(){
		require_once APPPATH."libraries/PHPExcel/Classes/PHPExcel.php";
		$objPHPExcel = new PHPExcel();
		//Propiedades de Documento
		$objPHPExcel->getProperties()->setCreator("fer")->setDescription("Reporte de estudiantes");
		//Establecemos la pestaña activa y nombre a la pestaña
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle("Productos");
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'LISTA DE ESTUDIANTES');

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('A2', '#');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'CARNET');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->setCellValue('C2', 'NOMBRE');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->setCellValue('D2', 'APELLIDOS');
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->setCellValue('E2', 'CELULAR');
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->setCellValue('F2', 'ESTADO');
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->setCellValue('G2', 'ROL');
		$con=1; 
		$c=3; 
   		foreach ($this->Modelo_crud->listar_usuarios()as $value) {  
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$c, $con++);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$c, $value->ci.' '.$value->expedido);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$c, $value->nombre);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$c, $value->paterno.' '.$value->materno);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$c, $value->celular);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$c, $value->estado);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$c, $value->roles);
			$c++;
   		} 

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.date("Hms").'LISTADOS.xls');
		header('Cache-Control: max-age=0');
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		// ob_end_clean();
	}
}