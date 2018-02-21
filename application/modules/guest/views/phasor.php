<div class="headerbar">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		<h5> 
    <?php
			$clientid = $this->session->userdata('client_id');
			$client_names = $this->session->userdata('client_names');
			$client_name_index = $this->session->userdata('client_name_index');
	        if(strlen($clientid)>0){
		        $key = array_search($clientid, $client_name_index); // $key = 2;
				echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">".$client_names[$key]."</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">".$this->session->userdata('meter_number')."</span>)";
		    }else{
				echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">No Client Name Selected</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">No Meter Number Selected</span>)";
		    }
		$max_value = "325";
		$middle_value = "225";
		$min_value = "125";
	?></h5>		
		</li>
	</ol>
</div>

<?php
$profileid=NULL;
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $profileid = $_POST['pid'];
 // $dateinstallation  = $_POST['date_of_installation'];
	//echo "--------1----------".$profileid."------------";
}else{
	 //$dateinstallation = date('m/d/Y',strtotime("-1 days"));
	 $taskid="";
	//echo "--------2----------".$profileid."------------".$taskid;
}

if(!empty($this->session->userdata('meter_number'))){




  ?>

<div class="container-fluid">
    <div class="row-fluid">
		<div class="card">

			<div class="card-header">
				<div class="row">
					<div class="col-sm-5">				
						<h5 class="card-title mb-0"><?php echo lang('phasor_graph'); ?></h5>
					</div>
					<div class="col-sm-7 d-none d-md-block">					
						<form name="client_meter" method="post">
							<table  style="float:right">
							  <tr>
								<!--<td>Select Avaliable Date: </td>
								<td>
								
									<input id="dp2" type="date" name="date_of_installation" id="date_of_installation" value="<?php echo $dateinstallation; ?>" onchange="document.getElementById('clientmeterchanged').value = '1'; document.forms['client_meter'].submit();">
									
								</td>-->
								<input type="hidden" name="clientmeterchanged" id="clientmeterchanged" value="0" />
									<input type="hidden" name="selectionchanged" id="selectionchanged" value="0" />
								<td>Select Avaliable Date & Time: </td>
								<td>
									<select class="form-control" name="pid" onchange="document.getElementById('selectionchanged').value = '1'; document.forms['client_meter'].submit();">
									  <option value=""></option>
									  <?php
										//2015-10-06
										$QueryResults = "select profileid,datentime from fi_meter_status where meternum=".$this->session->userdata('meter_number')." order by datentime desc limit 30";
										//select profileid,datentime from fi_meter_status order by datentime desc limit 2 
										//DATE_FORMAT(datentime,'%Y-%m-%d')='".$dateinstallation."' and

										$resultProject = mysql_query($QueryResults);
										$iknt=0;
										while ($row=mysql_fetch_array($resultProject)) {
										  $pid = $row["profileid"];
										  $value = $row["datentime"];
										  if(empty($profileid)){
											$isSelected = true;
											$profileid = $pid;
										  }else{
											$isSelected = ($profileid == $pid);
										  }

									  ?>
										<option value="<?php print $pid; ?>" <?php if($isSelected) print "selected"; ?>><?php print $value; ?></option>
									  <?php $iknt++;}

									   if($iknt==0){
											$profileid = "";
											$pid = "";
									   }
									  ?>
								  </select>
								</td>
							</tr>
							</table>
						</form>
					</div>
				</div>
			</div>

			<div class="card-body" style="background: #FFF;">
<?php //echo "<pre>".$QueryResults."</pre>"; ?>
<?php //echo "<pre>".$dateinstallation."</pre>"; ?>
	<style type="text/css">

			table.gridtable {
				font-family: verdana,arial,sans-serif;
				font-size:14px;
				color:#333333;
				border-width: 2px;
				border-color: #666666;
				#text-align: left;
				#vertical-align: top;
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


<table border=0 width="100%"><tr>
<?php
	if(!empty($profileid)){

		$rangle = 0;
		$yangle = 0;
		$bangle = 0;


		$QueryString1="select * from fi_meter_status where profileid=".$profileid;
		//echo "<pre>".$QueryString1."</pre>";
		$qry = mysql_query($QueryString1);
		$data = array();
		while($rows = mysql_fetch_array($qry))
		{
					$rangle = $rows['rangle'];
					$yangle = $rows['yangle'];
					$bangle = $rows['bangle'];


		?>
		   <td>
			<table class="table table-hover phasor-table" border="0" cellspacing="8" cellpadding="8" >
			    <caption>
			   		Phasor Data for <b><?php echo $rows['datentime']; ?></b>
			    </caption>
			    <colgroup>
			    <col class="table-light"/>
			    <col class="bg-danger" />
			    <col class="bg-warning" />
			    <col class="bg-info" />
				<col class="table-light">
			    </colgroup>
				<thead class="table-dark">
					<tr>
						<th>Parameters</th>
						<th>R Phase</th>
						<th>Y Phase</th>
						<th>B Phase</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
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
				</tbody>
			</table>

			</td>


			</br>

<td>
<?php

	$max_num=max($rangle,$yangle,$bangle);
	$min_num=min($rangle,$yangle,$bangle);

	$graph="<script type=\"text/javascript\">$(function () {
    $('#containerpolar').egscharts({
        chart: {
            polar: true
        },
        title: {
            text: ''
        },
        pane: {
            startAngle: 0,
            endAngle: 360
        },
        xAxis: {
            tickInterval: 90,
            min: 0,
            max: 360,
            labels: {
			        formatter: function() {
			          return '';
			        }
      			}
        },
        yAxis: {
            min: 0,
labels: {
			        formatter: function() {
			          return '';
			        }
      			}
        },
        plotOptions: {
            series: {
                pointStart: 0,
                pointInterval: 1
            },
            column: {
                pointPadding: 0,
                groupPadding: 0
            }
        },
        tooltip: {
			enabled: false
		},
        series: [{
            type: 'line',
            name: 'R Phase',
			color: '#DF5353',
            data: [";
			for($m = 1;$m <= 360; $m++){
				if($m==1){
					$graph=$graph."0";
				}else{
					if($m==90){
						$graph=$graph.",360";
					}else{
						$graph=$graph.",0";
					}
				}
			}
            $graph=$graph."]
        },{
            type: 'line',";
			$val1 = 0;
		   if ($rangle > 0)
		   {
				$val1= (90 - abs($rangle));
				$graph=$graph."name: 'R Phase Lead',";
		   }else{
			 	$val1= 90 + abs($rangle);
			 	$graph=$graph."name: 'R Phase Lag',";
		   }

			$graph=$graph."color: '#DF5353',
            data: [";

			$var2 = 0;
			if($rangle==$max_num){
				$var2=$max_value;
			}else if($rangle==$min_num){
				$var2=$min_value;
			}else if($rangle!=$max_num and $rangle!=$min_num){
				$var2=$middle_value;
			}

			$processed = 0;
			for($m = 1;$m <= 360; $m++){


				if($m==1){
					$graph=$graph."0";
				}else{
					if($m>$val1 and $processed==0){
						$graph=$graph.",".$var2;
						$processed = 1;
					}else{
						$graph=$graph.",0";
					}
				}

			}
            $graph=$graph."]
        },
		{
			type: 'line',
			name: 'Y Phase',
			color: '#DDDF0D',
			data: [";

			for($m = 1;$m <= 360; $m++){
				if($m==1){
					$graph=$graph."0";
				}else{
					if($m==200){
						$graph=$graph.",360";
					}else{
						$graph=$graph.",0";
					}
				}
			}

            $graph=$graph."]
		},{
            type: 'line',";
			$val1 = 0;
			  if ($yangle > 0)
			  {
				$val1= 200 - abs($yangle);
				$graph=$graph."name: 'Y Phase Lead',";
			  }else{
				$val1= (200 + abs($yangle));
				$graph=$graph."name: 'Y Phase Lag',";
			  }

			$graph=$graph."color: '#DDDF0D',
            data: [";

				$var2 = 0;
				if($yangle==$max_num){
					$var2=$max_value;
				}else if($yangle==$min_num){
					$var2=$min_value;
				}else if($yangle!=$max_num and $yangle!=$min_num){
					$var2=$middle_value;
				}

			$processed = 0;
			for($m = 1;$m <= 360; $m++){
				if($m==1){
					$graph=$graph."0";
				}else{
					if($m>$val1 and $processed==0){
						$graph=$graph.",".$var2;
						$processed = 1;
					}else{
						$graph=$graph.",0";
					}
				}

			}
            $graph=$graph."]
        },
		{
			type: 'line',
			name: 'B Phase',
			color: 'blue',
			data: [";

			for($m = 1;$m <= 360; $m++){
				if($m==1){
					$graph=$graph."0";
				}else{
					if($m==320){
						$graph=$graph.",360";
					}else{
						$graph=$graph.",0";
					}
				}
			}

			//$bangle = -100;

            $graph=$graph."]
		},{
            type: 'line',";
			$val1 = 0;
			  if ($bangle > 0)
			  {
				$val1= 320 - abs($bangle);
				$graph=$graph."name: 'B Phase Lead',";
			  }else{
				$val1= (320 + abs($bangle));
				if($val1>359){
					$val1 = abs($bangle) - 40;
				}
				$graph=$graph."name: 'B Phase Lag',";
			  }

			$graph=$graph."color: 'blue',
            data: [";

				$var2 = 0;
				if($bangle==$max_num){
					$var2=$max_value;
				}else if($bangle==$min_num){
					$var2=$min_value;
				}else if($bangle!=$max_num and $bangle!=$min_num){
					$var2=$middle_value;
				}

			$processed = 0;
			for($m = 1;$m <= 360; $m++){
				if($m==1){
					$graph=$graph."0";
				}else{
					if($m>$val1 and $processed==0){
						$graph=$graph.",".$var2;
						$processed = 1;
					}else{
						$graph=$graph.",0";
					}
				}
			}
            $graph=$graph."]
        }
        ]
    });
});</script>";
echo $graph;


?>

	<?php	}
	}

	}else{


	}

?>


<div id="containerpolar" style="min-width: 610px; max-width: 600px; height: 600px; margin: 0 auto"></div>
</td>
</tr>
</table>
			</div>
		</div>
	</div>

</div>




