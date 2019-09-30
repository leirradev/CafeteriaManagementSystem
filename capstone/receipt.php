<?php
require('fpdf2.php');
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
		//$this->Image('sample.png',40,5,20,20);
		//Arial bold 15
		$this->SetFont('Arial','',12);
		//Move to the right
		$this->Cell(80);
		//Title
		//$this->Cell(50,10,'Prepaid Cafeteria Official Receipt',0,0,'L');
		$this->Cell(-20,10,'Prepaid Cafeteria Official Receipt',0,0,'R');
		$name = $_SESSION['username'];
		$sql="SELECT * FROM admin where username = '$name'";
		$res=mysql_query($sql) or die ("db query failed" .mysql_error());
		while($fet=mysql_fetch_array($res)){
				$fname = $fet['fname'];
				$mi = $fet['mname'];
				$lname = $fet['lname'];
		}
		$this->Cell(5,50,'Cashier: '.$fname." ".$mi.". ".$lname,0,0,'R');
		date_default_timezone_set('Asia/Manila');
		$date = date('m/d/Y');
		$this->Cell(-35,60,'Date: '.$date,0,0,'R');
		date_default_timezone_set('Asia/Manila');
		$time = date('H:i:s A', time());
		$this->Cell(3,70,'Time: '.$time,0,0,'R');
		//echo $time;
		$this->Cell(15,80,'Location: Malolos, Bulacan',0,0,'R');
		$this->Cell(-16,90,'Transaction ID: '.$_GET['id'],0,0,'R');
		
		$this->Ln(70);
		//$this->Cell(-180,60,"Cashier: ",0,0,'C');
		//Line break
	
	}

	//Page footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		$this->Cell(0,10,'Official Receipt',0,0,'C');
	}
	
	
		function LoadData()
		{
			$result=mysql_query("SELECT * from transaction where status = 'CLAIM' and id = '{$_GET['id']}'");
			while($row=mysql_fetch_row($result)) 
			{ 
				$data[] = $row;
			}
			return $data;
		}
		
		
		
	
		//Colored table
		function ShowTable($data)
		{
			//Header
			//Data
			foreach($data as $row)
			{
				$item = $row[2];
				$dami = $row[3];
				$presyo = $row[4];
				$newitem = explode(",",$item);
				$newdami = explode(",",$dami);
				$newpresyo = explode(",",$presyo);
				//print_r($newitem);
				//print_r($newdami);
			}
			foreach($newitem as $data){
				$this->Cell(50,6,$data,0);
				$this->Ln();
				
			}
			$this->Ln();
			foreach($newdami as $data1){
				$this->Cell(50,6,$data1,0);
					$this->Ln();
		    }
			$this->Ln();
			foreach($newpresyo as $data2){
				$this->Cell(50,6,"Php ".$data2.".00",0);
					$this->Ln();
		    }
			$this->Ln();
		}
		
		//Colored table
		function ShowTable2($data)
		{
			foreach($data as $row)
			{
				$this->Cell(50,7,"Total: Php ".$row[5].".00",0);
			}
			$this->Ln();
		}
		
	}
	
//connecting to the database
			
$pdf=new PDF();
//Column titles
//$header2=array('Total');
//Data loading
$data=$pdf->LoadData();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->ShowTable($data);
$pdf->ShowTable2($data);
$pdf->Output();
?>