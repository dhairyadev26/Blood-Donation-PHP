<?php
	include('connection.php');
	session_start();
	if(isset($_POST['submit']))
	{
		$did=$_SESSION['did'];
		$last_place_donation=$_SESSION['city'];
		$email=$_SESSION['user_email'];
		$weight = $_POST['weight']; 
		$blood_pressure = $_POST['bloodpressure'];
		$pulse = $_POST['pulse'];
		$hemoglobin = $_POST['hemoglobin'];
		$need = $_POST['need'];
		$query = "SELECT * FROM donorlogin WHERE id='$did' AND status=0";
		$result= mysqli_query($conn , $query);
		$count= mysqli_num_rows($result);
		if($result)
		{
			
			if($count > 0)
			{
					
				while($row = mysqli_fetch_array($result))
				{
					
					$dname = $row['user_full_name'];
					$dbloodgroup = $row['blood_group'];
					$dnumber = $row['user_number'];
				}
				$report_date=date("Y-m-d");
				$dated=date('d',strtotime($report_date));
				$datem=date('m',strtotime($report_date));
				$datey=date('Y',strtotime($report_date));
				$report_date = $dated.'-'.$datem.'-'.$datey;
				$queryi= "SELECT * from donorlogin WHERE id='".$did."' ";
				$resulti = mysqli_query($conn,$queryi);
				$counti = mysqli_num_rows($resulti);
				if ($resulti)
				{
					
					if($counti == 1)
					{
						
						while($row = mysqli_fetch_array($resulti))
						{	
							
							$bl = $row['blood_donation'];
							$pl = $row['pletlets_donation'];
							$pa = $row['plasama_donation'];
							$ev = $row['attend_event'];
							$uname= $row['user_name'];
							if ($need == "Blood") 
							{
								
								$bl = $bl+1;	
							}
							elseif ($need == "Pletlets") 
							{
								
								$pl = $pl+1;
							}
							else
							{
								
								$pa = $pa+1;
							}
							$ev = $ev+1;
						}
						$td= $bl+$pl+$pa;
						$querys = "UPDATE donorlogin SET  weight='$weight',blood_pressure='$blood_pressure',pulse='$pulse',hemoglobin='$hemoglobin',blood_donation='$bl',pletlets_donation='$pl',plasama_donation='$pa',total_donation='$td',health_report='$report_date',attend_event='$ev',last_donation='$report_date',last_place_donation='$last_place_donation' WHERE id='".$did."' ";
						$result1=mysqli_query($conn, $querys);
						$queryt = "INSERT INTO `$uname` (`event_status`,`event_name`,`donation_date`,`donation_type`) VALUES (1,'".$_SESSION['user_full_name']."','".$report_date."','".$need."')";
							$resultt=mysqli_query($conn, $queryt);
							if($resultt)
							{
									$querya="INSERT INTO `$email` (`donor_id`,`user_full_name`,`user_number`,`blood_group`,`weight`,`blood_pressure`,`pulse`,`hemoglobin`,`donation_type`) VALUES('".$did."','".$dname."','".$dnumber."','".$dbloodgroup."','".$weight."','".$blood_pressure."','".$pulse."','".$hemoglobin."','".$need."') ";
										$resulta = mysqli_query($conn, $querya);
										if ($resulta) 
										{	
											echo '<script> alert("Donor Added .");
													window.location="donor_entry.php"; </script>';
										}
										else
										{
											
											echo '<script> alert("Error .");
													window.location="donor_entry.php"; </script>';	
										}
							}

					}
							else
							{
								
								echo '<script> alert("Donor ID is not registered.");</script>';
							}
					}
				}
		else
		{
			echo '<script> alert("Error.");
					window.location="donor_entry.php"; </script>';
		}
	}
}
?>