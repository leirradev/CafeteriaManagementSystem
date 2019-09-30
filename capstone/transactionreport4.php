<?php
require('fpdf.php');
include ("connection2.php");
session_start();
//error_reporting(E_ALL & ~E_NOTICE);
ini_set('error_reporting', 'E_ALL | E_STRICT');
 ini_set('error_reporting', 'E_ALL & ~E_NOTICE');

// production
 ini_set('error_reporting', 'E_ALL & ~E_DEPRECATED');


// development
ini_set('display_errors', 'On');
// production
 ini_set('display_errors', 'Off');
require "config.php";
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {

header ("Location: adminlogin.php");
}
	class PDF extends FPDF
	{
		function Header()
    {
		//Logo
		$this->Image('reportlogo.png',100,5,20,20);
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//Move to the right
		$this->Cell(80);
		//Title
		$this->Cell(150,10,'Prepaid Cafeteria Transaction Report',0,0,'C');
		
		//Line break
		$this->Ln(20);
	}

	//Page footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'Transaction-Report',0,0,'C');
	}
	
	
		function LoadData()
		{
			if(isset($_GET['product'])){
			$user = $_GET['product'];
			$result=mysql_query("SELECT * from transaction where product LIKE '%{$user}%' order by id desc");
			while($row=mysql_fetch_row($result)) 
			{ 
				$data[] = $row;
			}
			return $data;
			}
		}
		
		
	
		//Colored table
		function FancyTable($header,$data)
		{
			//Colors, line width and bold font
			$this->SetFillColor(255,0,0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.3);
			$this->SetFont('','B');
			//Header
			$w=array(30,30,20,35,30,30,30,30,35);
			
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$this->Ln();
			//Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			//Data
			$fill=false;
			foreach($data as $row)
			{
				$total = $_GET['total'];
				$this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
				$this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
				$this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
				$this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
				$this->Cell($w[4],6,$row[4],'LR',0,'C',$fill);
				$this->Cell($w[5],6,$row[5],'LR',0,'C',$fill);
				$this->Cell($w[6],6,$row[7],'LR',0,'C',$fill);
				$this->Cell($w[7],6,$row[8],'LR',0,'C',$fill);
				$this->Cell($w[8],6,$row[9],'LR',0,'C',$fill);

				$this->Ln();	
				$fill=!$fill;
			}
			
			$this->Cell(array_sum($w),0,'','T');
			$this->Ln();
		}
		function FancyTable2($header2,$data)
		{
			//Colors, line width and bold font
			$this->SetFillColor(255,0,0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.3);
			$this->SetFont('','B');
			//Header
			$w=array(135,135);
			for($i=0;$i<count($header2);$i++)
				$this->Cell($w[$i],7,$header2[$i],1,0,'C',true);
			$this->Ln();
			//Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			//Data
			$fill=false;
			$totalcount = 0;
			foreach($data as $row)
			{
				$totalcount = $totalcount + count($row[0]);
			}
				$total = $_GET['total'];
				$this->Cell($w[0],6,$total,'LR',0,'C',$fill);
				$this->Cell($w[1],6,$totalcount,'LR',0,'C',$fill);
				$this->Ln();				
				$fill=!$fill;
			
			$this->Cell(array_sum($w),0,'','T');
		}
		
	}
	
//connecting to the database
			
$pdf=new PDF();
//Column titles
$header=array('Transaction Id','User','Product','Quantity','Amount','Subtotal','Time Ordered','Time Claimed','Date Purchased');
$header2=array('Total Income','Total Transaction');
//Data loading
$data=$pdf->LoadData();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->FancyTable2($header2,$data);
$pdf->Output();
?>