<?php
		$host = 'localhost';
        $uname = 'root';
        $pwd = '';
        $db = 'onlinemarketplace';


        $con = mysql_connect($host,$uname,$pwd) or die("connection failed");
        mysql_select_db($db,$con) or die("db selection failed");

		$user=$_REQUEST['user'];
		$prod=$_REQUEST['product'];
		$qty=$_REQUEST['quantity'];
		$status="PENDING";
		date_default_timezone_set('Asia/Manila');
		$date = date('m/d/Y');
        $nick=  $date;
        $minuto=$_REQUEST['amount'];
		$oras=$_REQUEST['total'];
		date_default_timezone_set('Asia/Manila');
		$time = date('H:i A',time());
		$timeo= $time ;
       // $id_pelicula=$_REQUEST['id_pelicula'];

        $flag['code']=0;

        if($r=mysql_query("insert into transaction(user,product,quantity,date,amount,status,timeOrder,total) values('$user','$prod','$qty','$nick','$minuto','$status','$timeo','$oras') ",$con))
        {
            $flag['code']=1;
            echo"hi";
        }

        print(json_encode($flag));
        mysql_close($con);
		?>