<div class="headerbar">
<h1>
    <?php
	include('config.php');
			$clientid = $this->session->userdata('client_id');
			$client_names = $this->session->userdata('client_names');
			$client_name_index = $this->session->userdata('client_name_index');
	        if(strlen($clientid)>0){
		        $key = array_search($clientid, $client_name_index); // $key = 2;
				echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">".$client_names[$key]."</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">".$this->session->userdata('meter_number')."</span>)";
		    }else{
				echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">No Client Name Selected</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">No Meter Number Selected</span>)";
		    }
	?>
	</h1>
</div>

<?php
$profileid=1;


//echo "Meter No:".$this->session->userdata('meter_number');
//

   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
	  $profileid = $_POST['pid'];
	  $taskid  = $_POST['date_of_installation'];
		//echo "--------1----------".$profileid."------------".$taskid;
	}else{
		 $profileid = "";
		 $taskid="";
		// echo "--------2----------".$profileid."------------".$taskid;
	}


if(!empty($this->session->userdata('meter_number'))){

  ?>

<div class="container-fluid">
    <div class="row-fluid">
		<div class="widget">
			<div class="widget-title">
				<h5><?php echo lang('phasor'); ?></h5>
				<form name="client_meter" method="post">
					<table  style="float:right">
					  <tr>
						<td>Meter Phasor Date:</td>
						<td>
							<input type="date" name="date_of_installation" id="date_of_installation" value="<?php echo $taskid; ?>" onchange="document.getElementById('clientmeterchanged').value = '1'; document.forms['client_meter'].submit();">
							<input type="hidden" name="clientmeterchanged" id="clientmeterchanged" value="0" />
							<input type="hidden" name="selectionchanged" id="selectionchanged" value="0" />
						</td>
						<td>Phasor Meter Date:</td>
						<td>
						 	<select name="pid" onchange="document.getElementById('selectionchanged').value = '1'; document.forms['client_meter'].submit();">
							  <option value=""></option>
							  <?php
								$QueryResults = "select profileid,datentime from fi_meter_status where DATE_FORMAT(datentime,'%Y-%m-%d')='2015-10-06' and meternum=".$this->session->userdata('meter_number')." order by datentime asc";
								$resultProject = mysql_query($QueryResults);
								$iknt=0;
								while ($row=mysql_fetch_array($resultProject)) {
								  $pid = $row["profileid"];
								  $value = $row["datentime"];
								  $isSelected = ($profileid == $pid);
							  ?>
								<option value="<?php print $pid; ?>" <?php if($isSelected) print "selected"; ?>><?php print $value; ?></option>
							  <?php }
							  ?>
						  </select>
						</td>
					</tr>
					</table>
				</form>
			</div>

			<style type="text/css">

			table.gridtable {
				font-family: verdana,arial,sans-serif;
				font-size:16px;
				color:#333333;
				border-width: 2px;
				border-color: #666666;
				border-collapse: collapse;
			}
			table.gridtable th {
				border-width: 1px;
				padding: 8px;
				border-style: solid;
				border-color: #666666;
				background-color: #dedede;
			}
			.col1{background:white;border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;}
			.col2{background:red;border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;}
			.col3{background:#FFFF66;border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;}
			.col4{background:#58D3F7;border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;}
			.col5{background:white;border-width: 1px;padding: 8px;border-style: solid;border-color: #666666;}




			</style>
			</head>
			<body>

<?php
	if(!empty($profileid)){
		$QueryString1="select * from fi_meter_status where profileid=".$profileid;
		//echo "<pre>".$QueryString1."</pre>";
		$qry = mysql_query($QueryString1);
		$data = array();
		while($rows = mysql_fetch_array($qry))
		{ ?>
			<table class="gridtable" cellspacing="8" cellpadding="8" >
			    <caption>
			   ....
			    </caption>
			    <colgroup>
			    <col class="col1"/>
			    <col class="col2" />
			    <col class="col3" />
			    <col class="col4" />
				<col class="col5">
			    </colgroup>
			    <tr>
			        <th>Parameters</th>
			        <th>R Phase</th>
			        <th>Y Phase</th>
			        <th>B Phase</th>
					<th>Total</th>
			    </tr>
			    <tr>
			    	<td align="center">Voltage (V)</td>
			        <td align="center"><?php echo $rows['rvolt']; ?></td>
			        <td align="center"><?php echo $rows['yvolt']; ?></td>
			        <td align="center"><?php echo $rows['bvolt']; ?></td>
			        <td align="center"></td>
			    </tr>
			    <tr>
			    	<td align="center">Current (A)</td>
			        <td align="center"><?php echo $rows['rcurr']; ?></td>
			        <td align="center"><?php echo $rows['ycurr']; ?></td>
			        <td align="center"><?php echo $rows['bcurr']; ?></td>
			        <td align="center"></td>
			    </tr>


			    <tr>
			    	<td align="center">Phase Angle</td>
			        <td align="center"><?php echo $rows['rangle']; ?></td>
			        <td align="center"><?php echo $rows['yangle']; ?></td>
			        <td align="center"><?php echo $rows['bangle']; ?></td>
			        <td align="center"></td>
			     </tr>



			    <tr>
			    	<td align="center">Active Power (kW)</td>
			        <td align="center"><?php echo $rows['rkw']/1000; ?></td>
			        <td align="center"><?php echo $rows['ykw']/1000; ?></td>
			        <td align="center"><?php echo $rows['bkw']/1000; ?></td>
			        <td align="center"><?php echo ($rows['rkw']/1000 + $rows['ykw']/1000 + $rows['bkw']/1000) ?></td>
			    </tr>
				<tr>
			    	<td align="center">Reactive Power</td>
			        <td align="center"><?php echo $rows['rkvar']/1000; ?></td>
			        <td align="center"><?php echo $rows['ykvar']/1000; ?></td>
			        <td align="center"><?php echo $rows['bkvar']/1000; ?></td>
			        <td align="center"><?php echo ($rows['rkvar']/1000 + $rows['ykvar']/1000 + $rows['bkvar']/1000) ?></td>
			    </tr>


				<tr>
			    	<td align="center">Apparent Power</td>
			        <td align="center"><?php echo $rows['rkva']/1000; ?></td>
			        <td align="center"><?php echo $rows['ykva']/1000; ?></td>
			        <td align="center"><?php echo $rows['bkva']/1000; ?></td>
			        <td align="center"><?php echo ($rows['rkva']/1000 + $rows['ykva']/1000 + $rows['bkva']/1000) ?></td>
			    </tr>
				<tr>
			    	<td align="center">Power factor</td>
			        <td align="center"></td>
			        <td align="center"></td>
			        <td align="center"></td>
			        <td align="center"><?php echo $rows['pf']; ?></td>
			    </tr>
			</table>

	<?php	}
	}

	}else{


	}

?>

					</div>
	</div>
</div>