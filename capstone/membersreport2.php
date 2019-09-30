<?php
require('fpdf1.php');
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
		$this->Image('reportlogo.png',60,5,20,20);
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//Move to the right
		$this->Cell(80);
		//Title
		$this->Cell(30,10,'Prepaid Cafeteria',0,0,'C');
		//
		$this->Cell(-35,40,'List of Registered Members',0,0,'C');
		//Line break
		$this->Ln(30);
	}

	//Page footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		$this->Cell(0,10,'Page '.$this->PageNo().' Registered Accounts Report',0,0,'C');
	}
	
	
		function LoadData()
		{
			$name = $_GET['status'];
			$result=mysql_query("SELECT * from user where _status LIKE '%{$name}%' and deleted = 0 order by _username");
			while($row=mysql_fetch_row($result)) 
			{ 
				$data[] = $row;
			}
			return $data;
		}
		
		function LoadData2()
		{
			$result1=mysql_query("SELECT * from product order by name");
			while($row=mysql_fetch_row($result1)) 
			{ 
				$data2[] = $row;
			}
			return $data2;
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
			$w=array(40,40,40,40,55,25,30);
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
				$this->Cell($w[0],6,$row[1],'LR',0,'C',$fill);
				$this->Cell($w[1],6,$row[3],'LR',0,'C',$fill);
				$this->Cell($w[2],6,$row[4],'LR',0,'C',$fill);
				$this->Cell($w[3],6,$row[5],'LR',0,'C',$fill);
				$this->Cell($w[4],6,$row[6],'LR',0,'C',$fill);
				$this->Cell($w[5],6,"Php ".$row[7].".00",'LR',0,'C',$fill);
				$this->Cell($w[6],6,$row[8],'LR',0,'C',$fill);
				$this->Ln();
				$fill=!$fill;
			}
			$this->Cell(array_sum($w),0,'','T');
		}				
		
		//Colored table
		function FancyTable2($header2,$data)
		{
			//Colors, line width and bold font
			$this->SetFillColor(255,0,0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.3);
			$this->SetFont('','B');
			//Header
			$w=array(40,30,20,40);
			for($i=0;$i<count($header2);$i++)
				$this->Cell($w[$i],7,$header2[$i],1,0,'C',true);
			$this->Ln();
			//Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			//Data
			$fill=false;
			foreach($data as $row)
			{
				$this->Cell($w[0],6,$row[2],'LR',0,'C',$fill);
				//$this->Cell($w[1],6,$row[3],'LR',0,'L',$fill);
				$this->Cell($w[1],6,$row[4],'LR',0,'C',$fill);
				$this->Cell($w[2],6,"Php ".$row[5].".00",'LR',0,'C',$fill);
				$this->Cell($w[3],6,$row[8],'LR',0,'C',$fill);
				$this->Ln();	
				$fill=!$fill;
			}
			$this->Cell(array_sum($w),0,'','T');
		}
		
	}
	
//connecting to the database
			
$pdf=new PDF();
//Column titles
$header=array('Username','First Name','Last Name','Contact Number','Parents Contact Number','Load','Status');
//$header2=array('Product Name','Category','Price','Status');
//Data loading
$data=$pdf->LoadData();
//$data2=$pdf->LoadData2();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
//$pdf->AddPage();
//$pdf->FancyTable2($header2,$data2);
$pdf->Output();
?>