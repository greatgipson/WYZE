<?php
	include('config.php');

	$MeterNumber=$this->session->userdata('meter_number');

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$varbmsid = $_POST['bmsid'];
		if(!empty($_POST['monthid'])){
			$varmonthid = $_POST['monthid'];
			$varyearid = NULL;
		}else{
			$varmonthid =date('Y')."-".date('n');
		}
		if(!empty($_POST['yearid'])){
			$varyearid = $_POST['yearid'];
			$varmonthid = NULL;
		}else{
			$varyearid=date('Y');
			//$varmonthid =date('Y')."-".date('n');
		}
		//echo $varbmsid."----".$varmonthid."-----------".$varyearid;
	}else{
		$varbmsid = 1;
		$varmonthid=date('Y')."-".date('n');
		$varyearid = 0;
	}


?>


<script type="text/javascript">
	window.onload = function() {
		document.forms['myForm'].addEventListener('change', function() {
			this.submit();
		}, true);
	};

</script>
<div class="headerbar">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		<h5> 
<?php

function truncate_number( $number, $precision) {
    // Are we negative?
    if($number>0){
		$negative = $number / abs($number);
		// Cast the number to a positive to solve rounding
		$number = abs($number);
		// Calculate precision number for dividing / multiplying
		$precision = pow(10, $precision);
		// Run the math, re-applying the negative value to ensure returns correctly negative / positive
		$outputvalue= floor( $number * $precision ) / $precision * $negative;
		 return $outputvalue;
    }else{
		return 0;
    }
}


	function numberFormatPrecision( $number, $separator = '.', $format = 3 ){

			$response = '';
			$brokenNumber = explode( $separator, $number );
			$response = $brokenNumber[0] . $separator;
			$brokenBackNumber = str_split($brokenNumber[1]);

			if( $format < count($brokenBackNumber) ){

				for( $i = 1; $i <= $format; $i++ )
					$response .= $brokenBackNumber[$i];
			}

			return $response;
		}


		$clientid = $this->session->userdata('client_id');
		$client_names = $this->session->userdata('client_names');
		$client_name_index = $this->session->userdata('client_name_index');
        if(strlen($clientid)>0){
	        $key = array_search($clientid, $client_name_index); // $key = 2;
			echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">".$client_names[$key]."</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">".$this->session->userdata('meter_number')."</span>)";
	    }else{
			echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">No Client Name Selected</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">No Meter Number Selected</span>)";
	    }

			//echo "<br>Client ID:".$this->session->userdata('client_id');
			//echo "<br>Meter Number:".$this->session->userdata('meter_number');
			//echo "<br>Meter ID:".$this->session->userdata('meter_id_num');

	   if(!empty($this->session->userdata('meter_number'))){
	   ?> </h5>		
		</li>
	</ol>
</div>



	<div class="container-fluid">
		<div class="row-fluid">
				<div class="card">
						<div id="power-factor-content" class="modal hide fade in" style="display: none;width:900px;left: 30%;">
								<div class="modal-header">
									<a class="close" data-dismiss="modal">x</a>
									<?php if($varbmsid==1 AND !empty($varmonthid)){ ?>
												<h3>Daily Energy Consumption</h3>
										<?php }else if($varbmsid==2 AND !empty($varmonthid)){ ?>
												<h3>Weekly Energy Consumption</h3>
										<?php }else if($varbmsid==3 AND !empty($varyearid)){ ?>
												<h3>Monthly Energy Consumption</h3>
										<?php } ?>
								</div>
								<div class="modal-body">
									<div id="container1212" style="width: 850px; height: 400px; margin: 0 auto"></div>
								</div>
								<div class="modal-footer">
									<a href="#" class="btn" data-dismiss="modal">Close</a>
								</div>
						</div>
						<div class="card-header">
							<div class="row">
							<div class="col-sm-4">
								<h5 class="card-title mb-0"><?php echo lang('data_reports'); ?></h5>
							</div>
							<div class="col-sm-8 d-none d-md-block">	
							   <form id="myForm" method="POST">
									<div style="float:right" >
									<table>
									<tr>
									<!--<td>
									<?php if($varbmsid >0 and (!empty($varmonthid) OR !empty($varyearid))) { ?>
										<a data-toggle="modal" href="#power-factor-content" class="btn btn-primary"><i class="icon-eye icons"> </i>Usage Graph </a> &nbsp;&nbsp;&nbsp;&nbsp;
									<?php } ?>
									</td>-->
									<td></td>
									<td>
									<label>Select Report Type: </label>
									</td>
									<td>
											 <select class="form-control" id=bmsid name=bmsid onchange="document.forms['changebmsid'].submit()">
												<option value=""></option>
											<?php if($varbmsid==1){ ?>
													<option value="1" selected>Daily</option>
											 <?php }else { ?>
													<option value="1">Daily</option>
											 <?php }?>

											<?php if($varbmsid==2){ ?>
													<option value="2" selected>Weekly</option>
											 <?php }else { ?>
													<option value="2">Weekly</option>
											 <?php }?>

											<?php if($varbmsid==3){ ?>
													<option value="3" selected>Monthly</option>
											 <?php }else { ?>
													<option value="3">Monthly</option>
											 <?php }?>


											</select>

									</td>
									<td>
									<label>Select Period: </label>
									</td>
									<td>
											<?php

											if($varbmsid<3){
													echo "<select class='form-control' id=monthid name=monthid onchange='document.forms[" .  "'changemonthid'" . "].submit()'><option value=''></option>";

													$curYear = date('Y');

													for($m = 1;$m <= 12; $m++){
														$month =  date("F", mktime(0, 0, 0, $m, 1));



														if($varmonthid==($curYear."-".$m)){
															echo "<option value='".$curYear."-".$m."' selected>".$curYear."-".$month."</option>";
														}else{
															echo "<option value='".$curYear."-".$m."'>".$curYear."-".$month."</option>";
														}
													}

													$prevYear = date('Y', strtotime('-1 year'));

													//for ($i = $max-1; $i >=0 ; $i--)
													//for($m = 1;$m <= 12; $m++){
													for($m = 12;$m >= 1; $m--){
														$month =  date("F", mktime(0, 0, 0, $m, 1));
														if($varmonthid==($prevYear."-".$m)){
															echo "<option value='".$prevYear."-".$m."' selected>".$prevYear."-".$month."</option>";
														}else{
															echo "<option value='".$prevYear."-".$m."'>".$prevYear."-".$month."</option>";
														}
													}

													echo "</select>";
											}else{
												//$date_time = date('Y-m-d');
												$curYear = date('Y');
												$prevYear = $futureDate=date('Y', strtotime('-1 year'));;

												echo '<select id=yearid name=yearid onchange=\"document.forms[\'changeyearid\'].submit()\"><option value=""></option>';

												if($varyearid==$curYear){
													echo "<option value='".$curYear."' selected>".$curYear."</option>";
												}else {
													echo "<option value='".$curYear."'>".$curYear."</option>";
												 }

												 if($varyearid==$prevYear){
													echo "<option value='".$prevYear."' selected>".$prevYear."</option>";
												 }else {
												 	echo "<option value='".$prevYear."'>".$prevYear."</option>";
												 }

												echo "</select>";
											}
											?>
									</td>

									</tr>
									</table>
								   </form>
								</div>
							</div>
						</div>
				   </div>


							<?php

								//function truncate_number( $number, $precision) {
								///	$negative = $number / abs($number);
								//	$number = abs($number);
								//	$precision = pow(10, $precision);
								//	return floor( $number * $precision ) / $precision * $negative;
								//}

								$int = 1;
								$kW="";
								$kVA ="";
								$kVADemandArray ="";
								$PowerFactorArray ="";
								$AvgPowerFactor =0;
								$TotalPowerFactor =0;
								$kWdaytotal = 0.0;
								$kWnighttotal = 0.0;

			if($varbmsid==3 AND !empty($varyearid)){

								$graph1= "<script type=\"text/javascript\">
								$(function () {
								$('#container1212').egscharts({
								chart: {
									type: 'column'
								},
								title: {
									text: ''
								},
								subtitle: {
									text: ''
								},
								xAxis: {
									type: 'category',
									labels: {
										rotation: -45,
										style: {
											fontSize: '13px',
											fontFamily: 'Verdana, sans-serif'
										}
									}
								},
								yAxis: {
									min: 0,
									title: {
										text: ''
									}
								},
								legend: {
									enabled: false
								},
								tooltip: {
									pointFormat: 'kWh'
								},
								series: [{
									name: 'kWh',";
								$graph1= $graph1."data: [";


										$main_query = array();
										$query_period = array();

										$kCnt=0;
										for($m = 1;$m <= 12; $m++){
										{
											$end_month = $m+1;
											$varendyear = $varyearid;
											if($m==12){
												$varendyear = $varendyear + 1;

												$end_month  = 1;
											}

											$monthName = date("F", mktime(0, 0, 0, $m , 10));
											//$query_period[$kCnt] =  "<b>".$monthName."</b> (".trim($varyearid)."-".trim($m)."-".trim(1)." 00:30:00"." <b>to</b> ".trim($varendyear)."-".trim(($m+1))."-".trim(1)." 00:00:00)";
											$query_period[$kCnt] =  "<b>".$monthName."</b> (".trim($varyearid)."-".trim($m)."-".trim(1)." "." <b>to</b> ".trim($varendyear)."-".trim(($m+1))."-".trim(1)." )";

											$main_query[$kCnt]= "select meternum,DATE_FORMAT(dates,'%Y-%m-%d')  as meter_date_format,DATE_FORMAT(dates,'%H:%i:%s') as meter_time_format, dates,
											((fi_meter_data.activewh/1000)) as column1,(fi_meter_data.activeva/1000) as column2,(fi_meter_data.activevarh/1000) as column3
											FROM fi_meter_data where  meternum=".$MeterNumber." and
											dates BETWEEN ('".trim($varyearid)."-".trim($m)."-".trim(1)." 00:30:00') and
											('".trim($varendyear)."-".trim(($end_month))."-".trim(1)." 00:00:00')
											order by dates";

											//echo "<pre>".$main_query[$kCnt]."</pre>";

											$kCnt++;
										}

									}

									if($varbmsid==3 AND !empty($varyearid)){

										$table2 =  "<table id='item_table' class='items table table-striped table-bordered'><thead><tr>
											<th>Month</th>
											<th>kWh</th>
											<!--<th>kW</th>-->
											<th>kVArh</th>
											<th>kVA</th>
											<th>Power Factor</th>
											<th>kWh Day Consumption</th>
											<th>kWh Night Consumption</th>
										</tr>
										</thead><tbody>";
										//echo $main_query;
										$max = sizeof($main_query);
											//echo "MAX---->".$max.">>>>";
											$k=0;
											$daily_pf_data = array();

											$combokWdaytotal = "";
											$combokWnighttotal = "";
											$combokWkey = "";
											$kcnt = 0;
											for($i = 0; $i < $max;$i++)
											{
												//echo "<pre>"."---->".$main_query[$i]."<----</pre>";
												$int = 1;
												$kW  = 0;
												$kWh = 0;
												$kVAh = 0;
												$kVA = 0;
												$kWnighttotal  = 0;
												$kWdaytotal = 0;
												$PowerFactor=0;
												$PowerFactor_Date="";

												$qry = mysql_query($main_query[$i]);
												$j = 0;
												while($rows = mysql_fetch_array($qry))
												{
													$my_sql_date = $rows['dates'];
													$date_time = new DateTime($my_sql_date);

													$year= trim($date_time->format('Y').PHP_EOL);
													$month= trim($date_time->format('m').PHP_EOL);
													$day= trim($date_time->format('d').PHP_EOL);
													$hour= trim($date_time->format('H').PHP_EOL);
													$min= trim($date_time->format('i').PHP_EOL);
													$sec= trim($date_time->format('s'));

														//$kVADemand =(sqrt (($rows['column1']*$rows['column1'])+($rows['column3']*$rows['column3'])))*2;

														if($rows['column1']>0){
															$PowerFactor =($rows['column1']*2)/$rows['column2'];
															if($PowerFactor>0){
																$PowerFactor  = truncate_number($PowerFactor, 3);
															}
														}else{
															$PowerFactor=0;
														}

														//if($hour >=21 OR $hour<6){
														//	$kWnighttotal = $kWnighttotal + ($rows['column1']);
														//}else{
														//	$kWdaytotal= $kWdaytotal + ($rows['column1']);
														//}

																$hour_min = trim($date_time->format('H:i:s').PHP_EOL);
																//echo "<3333----".$hour_min."--->";
																if($hour_min== "21:30:00" OR $hour_min== "22:00:00" OR $hour_min== "22:30:00" OR $hour_min== "23:00:00"
																OR $hour_min== "23:30:00" OR $hour_min== "00:00:00" OR $hour_min== "00:30:00" OR $hour_min== "01:00:00"
																OR $hour_min== "01:30:00" OR $hour_min== "02:00:00" OR $hour_min== "02:30:00" OR $hour_min== "03:00:00"
																OR $hour_min== "03:30:00" OR $hour_min== "04:00:00" OR $hour_min== "04:30:00" OR $hour_min== "05:00:00"
																OR $hour_min== "05:30:00" OR $hour_min== "06:00:00"){
																//echo "<1111----".$hour_min."--->";
																	$kWnighttotal = $kWnighttotal + ($rows['column1']);
																}else{
																//echo "<2222----".$hour_min."--->";
																	$kWdaytotal= $kWdaytotal + ($rows['column1']);
																}

														$kWh = $kWh + $rows['column1'];
														$kW  = $kW + ($rows['column1']*2);
														$kVAh = $kVAh + $rows['column3'];
														$kVA = $rows['column2'];
														$PowerFactor_Date = $year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec;

														$daily_pf_data[$rows['column2']] = $PowerFactor."~".$PowerFactor_Date."~".$kVA;

												}//End While

												//echo $i."-->".$kWh.">>>>";
												if($kWh>0) {
													$table2 =  $table2."<tr class='item'>";
													if(!empty($query_period[$i])){
														$table2 =  $table2."<td>".$query_period[$i]."</td>";
														$graph1= $graph1."['(".$query_period[$i].")', ".$kWh."],";
													}else{
														$table2 =  $table2."<td></td>";
													}

													$max_pf_kva = array();
													$max_pf_kva = explode( '~', $daily_pf_data[max(array_keys($daily_pf_data))]);

													$table2 =  $table2."<td>".$kWh."</td>";
													//$table2 =  $table2."<td>".$kW."</td>";
													$table2 =  $table2."<td>".$kVAh."</td>";
													$table2 =  $table2."<td>".truncate_number($max_pf_kva[2],3)."</td>";
													//$table2 =  $table2."<td>".$PowerFactor." (".$PowerFactor_Date.")</td>";
													$table2 =  $table2."<td>".$max_pf_kva[0]." (".$max_pf_kva[1].")</td>";

													$table2 =  $table2."<td>".$kWdaytotal."</td>";
													$table2 =  $table2."<td>".$kWnighttotal."</td>";
													$table2 =  $table2."</tr>";


													if($kcnt==0){
															$combokWkey =  "'".$query_period[$i]."'";
															$combokWdaytotal =  $kWdaytotal;
															$combokWnighttotal =  $kWnighttotal;
													}else{
															$combokWkey =  $combokWkey.",'".$query_period[$i]."'";
															$combokWdaytotal =  $combokWdaytotal.",".$kWdaytotal;
															$combokWnighttotal =  $combokWnighttotal.",".$kWnighttotal;
													}

													$kcnt++;

												}

												$daily_pf_data = array();

											}//ForLoop END


								$graphcombo= "<script type=\"text/javascript\">
									$(function () {
								$('#container5555').egscharts({
									chart: {
										type: 'column'
									},
									title: {
										text: ''
									},
									xAxis: {
										categories: [".$combokWkey."]
									},
									yAxis: {
										min: 0,
										title: {
											text: 'Total Day and Night consumption'
										},
										stackLabels: {
											enabled: true,
											style: {
												fontWeight: 'bold',
												color: (egscharts.theme && egscharts.theme.textColor) || 'gray'
											}
										}
									},
									legend: {
										align: 'right',
										x: -30,
										verticalAlign: 'top',
										y: 25,
										floating: true,
										backgroundColor: (egscharts.theme && egscharts.theme.background2) || 'white',
										borderColor: '#CCC',
										borderWidth: 1,
										rotation: -90,
										shadow: false
									},
									tooltip: {
										formatter: function () {
											return '<b>' + this.x + '</b><br/>' +
												this.series.name + ': ' + this.y + '<br/>' +
												'Total: ' + this.point.stackTotal;
										}
									},
									plotOptions: {
										column: {
											stacking: 'normal',
											dataLabels: {
												enabled: true,
												rotation: -90,
												color: (egscharts.theme && egscharts.theme.dataLabelsColor) || 'white',
												style: {
													textShadow: '0 0 0px black'
												}
											}
										}
									},
									series: [{
												name: 'kWh Day',
												data: [".$combokWdaytotal."]
											}, {
												name: 'kWh Night',
												data: [".$combokWnighttotal."]
											}]
										});
									});
											</script>";

									echo $graphcombo;




										$table2 =  $table2."</tbody></table>";

													$graph1= $graph1."],
													dataLabels: {
														enabled: true,
														rotation: -90,
														color: '#FFFFFF',
														align: 'right',
														format: '{point.y:.1f}', // one decimal
														y: 10, // 10 pixels down from the top
														style: {
															fontSize: '11px',
															fontFamily: 'Verdana, sans-serif'
														}
													}
												}]
											});
										});
												</script>";

										echo $graph1;

			}//End of Main If Condition

			echo $table2;



								}


								if($varbmsid==1 AND !empty($varmonthid)){

									$val = explode("-",$varmonthid);
									$year = $val[0];
									$month = $val[1];

									$date = new DateTime();
									$date->setDate($year, $month, $month);
									$currentDay = $date->format("Y-m-d");

									$NextMonth = date('m', strtotime("+1 month", strtotime($currentDay)));
									$NextYear = date('Y', strtotime("+1 month", strtotime($currentDay)));


									$CurrMonth = date('m', strtotime("0 month", strtotime($currentDay)));
									$CurrYear = date('Y', strtotime("0 month", strtotime($currentDay)));


									$query= "select meternum,DATE_FORMAT(dates,'%Y-%m-%d')  as meter_date_format,DATE_FORMAT(dates,'%H:%i:%s') as meter_time_format, dates, ((fi_meter_data.activewh/1000)) as column1,(fi_meter_data.activeva/1000) as column2,(fi_meter_data.activevarh/1000) as column3 FROM fi_meter_data where  meternum=".$MeterNumber." and
									dates BETWEEN ('".$CurrYear."-".$CurrMonth."-01 00:30:00') AND ('".$NextYear."-".$NextMonth."-01 00:00:00') order by dates";
									//echo $query;

									$table =  "<table id='item_table' class='items table table-striped table-bordered'><thead><tr>
										<th>Day</th>
										<th>kWh</th>
										<!--<th>kW</th>-->
										<th>kVArh</th>
										<th>kVA</th>
										<th>Power Factor</th>
										<th>kWh Day Consumption</th>
										<th>kWh Night Consumption</th>
									</tr>
									</thead><tbody>";

									if(strlen($MeterNumber)>0 and !empty($query)){

											$graph_data= array();
											$graph_data_kwh_day=array();
											$graph_data_kwh_night=array();

											$temp_month = array();
											$max = sizeof($query);
											$k=0;
												//echo "<pre>"."---->".$query."</pre>";
												$int = 1;
												$kWh  = "";
												$kW  = "";
												$qry = mysql_query($query);
												$j = 0;
												$daily = array();
												$daily_pf_data = array();
												while($rows = mysql_fetch_array($qry))
												{
													$my_sql_date = $rows['dates'];
													$date_time = new DateTime($my_sql_date);

													$year= trim($date_time->format('Y').PHP_EOL);
													$month= trim($date_time->format('m').PHP_EOL);
													$day= trim($date_time->format('d').PHP_EOL);
													$hour= trim($date_time->format('H').PHP_EOL);
													$min= trim($date_time->format('i').PHP_EOL);
													$sec= trim($date_time->format('s'));

													$key = $rows['meter_date_format'];
													if (array_key_exists($key, $daily)){
														//print "----------".$daily[$key]."---------------------------------------------------------------------------";

														$daily_data = $daily[$rows['meter_date_format']];
														//print_r($daily_data);
														$kWh = $daily_data[0];
														$kW = $daily_data[1];
														$kVAh = $daily_data[2];
														$kVA = $daily_data[3];
														//$daily_pf_data = $daily_data[4];
														$kWnighttotal = $daily_data[5];
														//$kWdaytotal = $daily_data[6];
														$kWhdaytotal = $daily_data[8];

														//$kVADemand =(sqrt (($rows['column1']*$rows['column1'])+($rows['column3']*$rows['column3'])))*2;

														if($rows['column1']>0){
															if($rows['column2']>0){
																$PowerFactor =($rows['column1']*2)/$rows['column2'];
																if($PowerFactor>0){
																	$PowerFactor  = truncate_number($PowerFactor, 3);
																}
															}else{
																$PowerFactor=0;
															}
														}else{
															$PowerFactor=0;
														}

														//if($hour >=21 OR $hour<6){
														//	$kWnighttotal = $kWnighttotal + ($rows['column1']);
														//}else{
														//	$kWhdaytotal= $kWhdaytotal + ($rows['column1']);
														//}

		$hour_min = trim($date_time->format('H:i:s').PHP_EOL);
		//echo "<3333----".$hour_min."--->";
		if($hour_min== "21:30:00" OR $hour_min== "22:00:00" OR $hour_min== "22:30:00" OR $hour_min== "23:00:00"
		OR $hour_min== "23:30:00" OR $hour_min== "00:00:00" OR $hour_min== "00:30:00" OR $hour_min== "01:00:00"
		OR $hour_min== "01:30:00" OR $hour_min== "02:00:00" OR $hour_min== "02:30:00" OR $hour_min== "03:00:00"
		OR $hour_min== "03:30:00" OR $hour_min== "04:00:00" OR $hour_min== "04:30:00" OR $hour_min== "05:00:00"
		OR $hour_min== "05:30:00" OR $hour_min== "06:00:00"){
		//echo "<1111----".$hour_min."--->";
			$kWnighttotal = $kWnighttotal + ($rows['column1']);
		}else{
		//echo "<2222----".$hour_min."--->";
			$kWhdaytotal= $kWhdaytotal + ($rows['column1']);
		}


														$kWh = $kWh + $rows['column1'];
														$kW  = $kW + ($rows['column1']*2);
														$kVAh = $kVAh + $rows['column3'];
														$kVA = $kVA + $rows['column2'];

														//kWh
														$daily_data[0] = $kWh;

														//KW
														$daily_data[1] = $kW;

														//kVArh
														$daily_data[2] = $kVAh;

														//kVA
														$daily_data[3] = $rows['column2'];

														$daily_pf_data[$rows['column2']] = $PowerFactor." (".$year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec.")"."~".$rows['column2'];

														//PF
														$daily_data[4] = $daily_pf_data;

														$daily_data[5] = $kWnighttotal;
														$daily_data[6] = $kWdaytotal;

														$daily_data[7] = $year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec;
														$daily_data[8] = $kWhdaytotal;


														$daily[$rows['meter_date_format']] = $daily_data;
													}else{

														if($rows['meter_time_format']=="00:00:00"){

																$date_time->modify('-1 day');
																//echo $date_time->format('Y-m-d');//2017-04-06

																if(!empty($daily_data)){
																		$max = sizeof($daily);
																		//echo "<pre>".$max."-".$date_time->format('Y-m-d')."</pre>";
																		//print_r($daily);
																		if(!isset($daily[$date_time->format('Y-m-d')]) && array_key_exists($date_time->format('Y-m-d'), $daily)){
																		$daily_data = $daily[$date_time->format('Y-m-d')];
																		//print_r($daily_data);
																		$kWh = $daily_data[0];
																		$kW = $daily_data[1];
																		$kVAh = $daily_data[2];
																		$kVA = $daily_data[3];
																		//$daily_pf_data = $daily_data[4];
																		$kWnighttotal = $daily_data[5];
																		//$kWdaytotal = $daily_data[6];
																		$kWhdaytotal = $daily_data[8];

																		//$kVADemand =(sqrt (($rows['column1']*$rows['column1'])+($rows['column3']*$rows['column3'])))*2;

																		if($rows['column1']>0){
																			$PowerFactor =($rows['column1']*2)/$rows['column2'];
																			if($PowerFactor>0){
																				$PowerFactor  = truncate_number($PowerFactor, 3);
																			}
																		}else{
																			$PowerFactor=0;
																		}

																		//if($hour >=21 OR $hour<6){
																		///	$kWnighttotal = $kWnighttotal + ($rows['column1']);
																		//}else{
																		//	$kWhdaytotal= $kWhdaytotal + ($rows['column1']);
																		//}

																$hour_min = trim($date_time->format('H:i:s').PHP_EOL);
		//echo "<3333----".$hour_min."--->";
		if($hour_min== "21:30:00" OR $hour_min== "22:00:00" OR $hour_min== "22:30:00" OR $hour_min== "23:00:00"
		OR $hour_min== "23:30:00" OR $hour_min== "00:00:00" OR $hour_min== "00:30:00" OR $hour_min== "01:00:00"
		OR $hour_min== "01:30:00" OR $hour_min== "02:00:00" OR $hour_min== "02:30:00" OR $hour_min== "03:00:00"
		OR $hour_min== "03:30:00" OR $hour_min== "04:00:00" OR $hour_min== "04:30:00" OR $hour_min== "05:00:00"
		OR $hour_min== "05:30:00" OR $hour_min== "06:00:00"){
		//echo "<1111----".$hour_min."--->";
			$kWnighttotal = $kWnighttotal + ($rows['column1']);
		}else{
		//echo "<2222----".$hour_min."--->";
			$kWhdaytotal= $kWhdaytotal + ($rows['column1']);
		}


																		$kWh = $kWh + $rows['column1'];
																		$kW  = $kW + ($rows['column1']*2);
																		$kVAh = $kVAh + $rows['column3'];
																		$kVA = $kVA + $rows['column2'];


																		//kWh
																		$daily_data[0] = $kWh;

																		//KW
																		$daily_data[1] = $kW;

																		//kVArh
																		$daily_data[2] = $kVAh;

																		//kVA
																		$daily_data[3] = $rows['column2'];

																		$daily_pf_data[$rows['column2']] = $PowerFactor." (".$year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec.")"."~".$rows['column2'];

																		//PF
																		$daily_data[4] = $daily_pf_data;


																		//kWnighttotal
																		$daily_data[5] = $kWnighttotal;

																		//kWdaytotal
																		$daily_data[6] = $kWdaytotal;

																		$daily_data[7] = $year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec;
																		$daily_data[8] = $kWhdaytotal;

																		$daily[$date_time->format('Y-m-d')] = $daily_data;
																}
															}
														}else{
																$kWnighttotal = 0;
																$kWhdaytotal = 0;

																$daily_data = array();
																$daily_pf_data = array();

																//$kVADemand =(sqrt (($rows['column1']*$rows['column1'])+($rows['column3']*$rows['column3'])))*2;

																if($rows['column1']>0 ){
																	if($rows['column2']>0){
																		$PowerFactor =($rows['column1']*2)/$rows['column2'];
																		if($PowerFactor>0){
																			$PowerFactor  = truncate_number($PowerFactor, 3);
																		}
																	}else{
																		$PowerFactor=0;
																	}
																}else{
																	$PowerFactor=0;
																}

																//if($hour >=21 OR $hour<6){
																///	$kWnighttotal = ($rows['column1']);
																//}else{
																//	//$kWdaytotal= ($rows['column1']);
																//	$kWhdaytotal= ($rows['column1']);
																//}


																$hour_min = trim($date_time->format('H:i:s').PHP_EOL);
																//echo "<3333----".$hour_min."--->";
																if($hour_min== "21:30:00" OR $hour_min== "22:00:00" OR $hour_min== "22:30:00" OR $hour_min== "23:00:00"
																OR $hour_min== "23:30:00" OR $hour_min== "00:00:00" OR $hour_min== "00:30:00" OR $hour_min== "01:00:00"
																OR $hour_min== "01:30:00" OR $hour_min== "02:00:00" OR $hour_min== "02:30:00" OR $hour_min== "03:00:00"
																OR $hour_min== "03:30:00" OR $hour_min== "04:00:00" OR $hour_min== "04:30:00" OR $hour_min== "05:00:00"
																OR $hour_min== "05:30:00" OR $hour_min== "06:00:00"){
																//echo "<1111----".$hour_min."--->";
																	$kWnighttotal = ($rows['column1']);
																}else{
																//echo "<2222----".$hour_min."--->";
																	$kWhdaytotal= ($rows['column1']);
																}



																$kWh = $rows['column1'];
																$kW  = ($rows['column1']*2);
																$kVA = $rows['column2'];
																$kVAh = $rows['column3'];

																//kWh
																$daily_data[0] = $kWh;

																//KW
																$daily_data[1] = $kW;

																//kVArh
																$daily_data[2] = $kVAh;

																//kVA
																$daily_data[3] = $kVA;

																$daily_pf_data[$rows['column2']] = $PowerFactor." (".$year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec.")"."~".$rows['column2'];

																//PF
																$daily_data[4] = $daily_pf_data;

																$daily_data[5] = $kWnighttotal;

																$daily_data[6] = $kWdaytotal;

																$daily_data[7] = $year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec;

																$daily_data[8] = $kWhdaytotal;

																$daily[$rows['meter_date_format']] = $daily_data;
																}

													}
											}//End While

											//echo "<pre>".print_r($daily)."</pre>";





				       $graph2= "<script type=\"text/javascript\">
						$(function () {
						    $('#container1212').egscharts({
						        chart: {
						            type: 'column'
						        },
						        title: {
						            text: ''
						        },
						        subtitle: {
						            text: ''
						        },
						        xAxis: {
						            type: 'category',
						            labels: {
						                rotation: -45,
						                style: {
						                    fontSize: '11px',
						                    fontFamily: 'Verdana, sans-serif'
						                }
						            }
						        },
						        yAxis: {
						            min: 0,
						            title: {
						                text: ''
						            }
						        },
						        legend: {
						            enabled: false
						        },
						        tooltip: {
						            pointFormat: 'kWh'
						        },
						        series: [{
						            name: 'kWh',";
						            $graph2= $graph2."data: [";
									$combokWdaytotal = "";
									$combokWnighttotal = "";
									$combokWkey = "";


									$kcnt=0;
									foreach ($daily as $key => $daily_data)
									{
											//$daily_data = $daily[$i];
											//print_r($daily_data);
											$vkWh = $daily_data[0];
											$vkW = $daily_data[1];
											$vkVAh = $daily_data[2];
											$vkVA = $daily_data[3];
											//$vdaily_pf_data = $daily_data[4];
											$vdaily_pf_data = $daily_data[4];
											$vkWnighttotal = $daily_data[5];
											$vkWdaytotal = $daily_data[8];

											$max_pf_kva = array();
											$max_pf_kva = explode( '~', $vdaily_pf_data[max(array_keys($vdaily_pf_data))]);

											$graph2= $graph2."['".$key."', ".$vkWh."],";
											$table =  $table."<tr class='item'>";
											$table =  $table."<td>".$key."</td>";
											$table =  $table."<td>".$vkWh."</td>";
											//$table =  $table."<td>".$vkW."</td>";
											$table =  $table."<td>".$vkVAh."</td>";
											$table =  $table."<td>".truncate_number($max_pf_kva[1],3)."</td>";
											//$table =  $table."<td>".$vdaily_pf_data." (".$daily_data[7].")</td>";
											$table =  $table."<td>".$max_pf_kva[0]."</td>";


											$table =  $table."<td>".$vkWdaytotal."</td>";
											$table =  $table."<td>".$vkWnighttotal."</td>";
											$table =  $table."</tr>";
											if($kcnt==0){
													$combokWkey =  "'".$key."'";
													$combokWdaytotal =  $vkWdaytotal;
													$combokWnighttotal =  $vkWnighttotal;
											}else{
													$combokWkey =  $combokWkey.",'".$key."'";
													$combokWdaytotal =  $combokWdaytotal.",".$vkWdaytotal;
													$combokWnighttotal =  $combokWnighttotal.",".$vkWnighttotal;
											}

											$kcnt++;
									}

									$table =  $table."</tbody></table>";
									echo $table;
								}//End if Condition




								$graphcombo= "<script type=\"text/javascript\">
									$(function () {
								$('#container5555').egscharts({
									chart: {
										type: 'column'
									},
									title: {
										text: ''
									},
									xAxis: {
										categories: [".$combokWkey."]
									},
									yAxis: {
										min: 0,
										title: {
											text: 'Total Day and Night consumption'
										},
										stackLabels: {
											enabled: true,
											style: {
												fontWeight: 'bold',
												color: (egscharts.theme && egscharts.theme.textColor) || 'gray'
											}
										}
									},
									legend: {
										align: 'right',
										x: -30,
										verticalAlign: 'top',
										y: 25,
										floating: true,
										backgroundColor: (egscharts.theme && egscharts.theme.background2) || 'white',
										borderColor: '#CCC',
										borderWidth: 1,
										rotation: -90,
										shadow: false
									},
									tooltip: {
										formatter: function () {
											return '<b>' + this.x + '</b><br/>' +
												this.series.name + ': ' + this.y + '<br/>' +
												'Total: ' + this.point.stackTotal;
										}
									},
									plotOptions: {
										column: {
											stacking: 'normal',
											dataLabels: {
												enabled: true,
												rotation: -90,
												color: (egscharts.theme && egscharts.theme.dataLabelsColor) || 'white',
												style: {
													textShadow: '0 0 0px black'
												}
											}
										}
									},
									series: [{
												name: 'kWh Day',
												data: [".$combokWdaytotal."]
											}, {
												name: 'kWh Night',
												data: [".$combokWnighttotal."]
											}]
										});
									});
											</script>";

									echo $graphcombo;





						            $graph2= $graph2."],
						            dataLabels: {
						                enabled: true,
						                rotation: -90,
						                color: '#FFFFFF',
						                align: 'right',
						                format: '{point.y:.1f}', // one decimal
						                y: 10, // 10 pixels down from the top
						                style: {
						                    fontSize: '11px',
						                    fontFamily: 'Verdana, sans-serif'
						                }
						            }
						        }]
						    });
						});
								</script>";

								echo $graph2;

								}//End if Condition




								if($varbmsid==2 AND !empty($varmonthid)){
									$val = explode("-",$varmonthid);
									$year = $val[0];
									$month = $val[1];

									$date = new DateTime();
									$date->setDate($year, $month, $month);
									$currentDay = $date->format("Y-m-d");

									$NextMonth = date('m', strtotime("+1 month", strtotime($currentDay)));
									$NextYear = date('Y', strtotime("+1 month", strtotime($currentDay)));


									$Query1="SELECT
									distinct DATE_ADD(dates, INTERVAL(2-DAYOFWEEK(dates)) DAY) as week_start,
									DATE_ADD(dates, INTERVAL(9-DAYOFWEEK(dates)) DAY) as week_end FROM fi_meter_data where  meternum=".$MeterNumber."
									AND dates BETWEEN ('".$currentDay." 00:30:00')
									AND ('".$NextYear."-".$NextMonth."-01 00:00:00') GROUP BY YEAR(dates) + .01 * WEEK(dates) order by dates desc";


									//echo "<pre>"."---->".$Query1."</pre>";
									$qry1 = mysql_query($Query1);

									$week_start_array = array();
									$week_end_array = array();

									$icnt = 0;
									if($varbmsid>0){
											while($rows1 = mysql_fetch_array($qry1))
											{
												$week_start_array[$icnt] = $rows1['week_start'];
												$week_end_array[$icnt] = $rows1['week_end'];
												$icnt++;
											}

										if(!empty($week_start_array)){
											$day_1= $week_start_array[0];
											$day_2 = (new DateTime($week_start_array[0]))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
											$day_3  =(new DateTime($day_2))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
											$day_4  =(new DateTime($day_3))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
											$day_5  =(new DateTime($day_4))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
											$day_6  =(new DateTime($day_5))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
											$day_7  =(new DateTime($day_6))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
											$day_8  =(new DateTime($day_7))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');

											$hour = array("00","01","01","02","02","03","03","04","04","05","05","06","06","07","07","08","08","09","09","10","10","11","11","12","12","13","13","14","14","15","15","16","16","17","17","18","18","19","19","20","20","21","21","22","22","23","23");
											$minute = array("30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00");

											$date_array = array();
											$date_array_cnt = 0;
											$date_time = new DateTime($day_1);
											$year= $date_time->format('y').PHP_EOL;
											$month= $date_time->format('m').PHP_EOL;
											$day= $date_time->format('d').PHP_EOL;
											$max = sizeof($hour);
											for($i = 0; $i < $max;$i++)
											{
											   if($i==0){
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }else{
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }
											   $date_array_cnt ++;
											}

											$date_time = new DateTime($day_2);
											$year= $date_time->format('y').PHP_EOL;
											$month= $date_time->format('m').PHP_EOL;
											$day= $date_time->format('d').PHP_EOL;
											$max = sizeof($hour);
											for($i = 0; $i < $max;$i++)
											{
											   if($i==0){
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }else{
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }
											   $date_array_cnt++;
											}

											$date_time = new DateTime($day_3);
											$year= $date_time->format('y').PHP_EOL;
											$month= $date_time->format('m').PHP_EOL;
											$day= $date_time->format('d').PHP_EOL;
											$max = sizeof($hour);
											for($i = 0; $i < $max;$i++)
											{
											   if($i==0){
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }else{
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }
											   $date_array_cnt++;
											}

											$date_time = new DateTime($day_4);
											$year= $date_time->format('y').PHP_EOL;
											$month= $date_time->format('m').PHP_EOL;
											$day= $date_time->format('d').PHP_EOL;
											$max = sizeof($hour);
											for($i = 0; $i < $max;$i++)
											{
											   if($i==0){
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }else{
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }
											   $date_array_cnt++;
											}

											$date_time = new DateTime($day_5);
											$year= $date_time->format('y').PHP_EOL;
											$month= $date_time->format('m').PHP_EOL;
											$day= $date_time->format('d').PHP_EOL;
											$max = sizeof($hour);
											for($i = 0; $i < $max;$i++)
											{
											   if($i==0){
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }else{
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }

											   $date_array_cnt++;
											}

											$date_time = new DateTime($day_6);
											$year= $date_time->format('y').PHP_EOL;
											$month= $date_time->format('m').PHP_EOL;
											$day= $date_time->format('d').PHP_EOL;
											$max = sizeof($hour);
											for($i = 0; $i < $max;$i++)
											{
											   if($i==0){
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }else{
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }
											   $date_array_cnt++;
											}

											$date_time = new DateTime($day_7);
											$year= $date_time->format('y').PHP_EOL;
											$month= $date_time->format('m').PHP_EOL;
											$day= $date_time->format('d').PHP_EOL;
											$max = sizeof($hour);
											for($i = 0; $i < $max;$i++)
											{
											   if($i==0){
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }else{
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }
											   $date_array_cnt++;
											}

											$date_time = new DateTime($day_8);
											$year= $date_time->format('y').PHP_EOL;
											$month= $date_time->format('m').PHP_EOL;
											$day= $date_time->format('d').PHP_EOL;
											$max = sizeof($hour);
											for($i = 0; $i < 1;$i++)
											{
											   if($i==0){
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }else{
													$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
													$date_array[$date_array_cnt] = $kW_S;
											   }
											   $date_array_cnt++;
											}

											$main_query = array();
											$query_period = array();
											$max = sizeof($week_start_array);

											//for($i = 0; $i < $max;$i++)
											for ($i = $max-1; $i >=0 ; $i--)
											{
												$date_time = new DateTime($week_start_array[$i]);
												$year= $date_time->format('y').PHP_EOL;
												$month= $date_time->format('m').PHP_EOL;
												$day= $date_time->format('d').PHP_EOL;

												$date_time1 = new DateTime($week_end_array[$i]);
												$year1= $date_time1->format('y').PHP_EOL;
												$month1= $date_time1->format('m').PHP_EOL;
												$day1= $date_time1->format('d').PHP_EOL;

												//$query_period[$i] = trim($year)."-".trim($month)."-".trim($day)." 00:30:00"." <b>to</b> ".trim($year1)."-".trim($month1)."-".trim($day1)." 00:00:00";
												$query_period[$i] = trim($year)."-".trim($month)."-".trim($day)." "." <b>to</b> ".trim($year1)."-".trim($month1)."-".trim($day1)." ";
												$main_query[$i]= "select meternum,DATE_FORMAT(dates,'%Y-%m-%d')  as meter_date_format,DATE_FORMAT(dates,'%H:%i:%s') as meter_time_format, dates, ((fi_meter_data.activewh/1000)) as column1,(fi_meter_data.activeva/1000) as column2,(fi_meter_data.activevarh/1000) as column3 FROM fi_meter_data where  meternum=".$MeterNumber." and dates BETWEEN ('".trim($year)."-".trim($month)."-".trim($day)." 00:30:00') and ('".trim($year1)."-".trim($month1)."-".trim($day1)." 00:00:00') order by dates";
											}

											}
										}
								   }


									if(strlen($MeterNumber)>0 and !empty($main_query) and $varbmsid==2 AND !empty($varmonthid)){








						$graph3= "<script type=\"text/javascript\">
						$(function () {
						    $('#container1212').egscharts({
						        chart: {
						            type: 'column'
						        },
						        title: {
						            text: ''
						        },
						        subtitle: {
						            text: ''
						        },
						        xAxis: {
						            type: 'category',
						            labels: {
						                rotation: -45,
						                style: {
						                    fontSize: '11px',
						                    fontFamily: 'Verdana, sans-serif'
						                }
						            }
						        },
						        yAxis: {
						            min: 0,
						            title: {
						                text: ''
						            }
						        },
						        legend: {
						            enabled: false
						        },
						        tooltip: {
						            pointFormat: 'kWh'
						        },
						        series: [{
						            name: 'kWh',";
						            $graph3= $graph3."data: [";


												$table1 =  "<table id='item_table' class='items table table-striped table-bordered'><thead><tr>
													<th>Week</th>
													<th>kWh</th>
													<!--<th>kW</th>-->
													<th>kVArh</th>
													<th>kVA</th>
													<th>Power Factor</th>
													<th>kWh Day Consumption</th>
													<th>kWh Night Consumption</th>
												</tr>
												</thead><tbody>";

											$max = sizeof($main_query);
											$k=0;

											//for($i = 0; $i < $max;$i++)

											$combokWdaytotal = "";
											$combokWnighttotal = "";
											$combokWkey = "";

											$kcnt = 0;
											for ($i = $max-1; $i >=0 ; $i--)
											{
												//echo "<pre>"."---->".$main_query[$i]."</pre>";
												$int = 1;
												$kW  = 0;
												$kWh = 0;
												$kVAh = 0;
												$kVA = 0;
												$kWnighttotal  = 0;
												$kWdaytotal = 0;
												$PowerFactor=0;
												$PowerFactor_Date="";

												$daily_pf_data = array();
												$qry = mysql_query($main_query[$i]);
												$j = 0;

												while($rows = mysql_fetch_array($qry))
												{
													$my_sql_date = $rows['dates'];
													$date_time = new DateTime($my_sql_date);

													$year= trim($date_time->format('Y').PHP_EOL);
													$month= trim($date_time->format('m').PHP_EOL);
													$day= trim($date_time->format('d').PHP_EOL);
													$hour= trim($date_time->format('H').PHP_EOL);
													$min= trim($date_time->format('i').PHP_EOL);
													$sec= trim($date_time->format('s'));

													//$kVADemand =(sqrt (($rows['column1']*$rows['column1'])+($rows['column3']*$rows['column3'])))*2;

													if($rows['column1']>0){
														$PowerFactor =($rows['column1']*2)/$rows['column2'];
														if($PowerFactor>0){
															$PowerFactor  = truncate_number($PowerFactor, 3);
														}
													}else{
														$PowerFactor=0;
													}

													//if($hour >=21 OR $hour<6){
													///	$kWnighttotal = $kWnighttotal + ($rows['column1']);
													//}else{
													//	$kWdaytotal= $kWdaytotal + ($rows['column1']);
													//}

													$hour_min = trim($date_time->format('H:i:s').PHP_EOL);
													//echo "<3333----".$hour_min."--->";
													if($hour_min== "21:30:00" OR $hour_min== "22:00:00" OR $hour_min== "22:30:00" OR $hour_min== "23:00:00"
													OR $hour_min== "23:30:00" OR $hour_min== "00:00:00" OR $hour_min== "00:30:00" OR $hour_min== "01:00:00"
													OR $hour_min== "01:30:00" OR $hour_min== "02:00:00" OR $hour_min== "02:30:00" OR $hour_min== "03:00:00"
													OR $hour_min== "03:30:00" OR $hour_min== "04:00:00" OR $hour_min== "04:30:00" OR $hour_min== "05:00:00"
													OR $hour_min== "05:30:00" OR $hour_min== "06:00:00"){
													//echo "<1111----".$hour_min."--->";
														$kWnighttotal = $kWnighttotal + ($rows['column1']);
													}else{
													//echo "<2222----".$hour_min."--->";
														$kWdaytotal= $kWdaytotal + ($rows['column1']);
													}

													$kWh = $kWh + $rows['column1'];
													$kW  = $kW + ($rows['column1']*2);
													$kVAh = $kVAh + $rows['column3'];
													$kVA = $rows['column2'];
													$PowerFactor_Date = $year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec;
													$daily_pf_data[$rows['column2']] = $PowerFactor." (".$year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec.")"."~".$rows['column2'];

											}//End While
													$table1 =  $table1."<tr class='item'>";
													if(!empty($query_period[$i])){
														$table1 =  $table1."<td>".$query_period[$i]."</td>";
														$graph3= $graph3."['(".$query_period[$i].")', ".$kWh."],";
													}else{
														$table1 =  $table1."<td></td>";

													}

													$max_pf_kva = array();
													if(!empty($daily_pf_data)){
													$max_pf_kva = explode( '~', $daily_pf_data[max(array_keys($daily_pf_data))]);


													$table1 =  $table1."<td>".$kWh."</td>";
													//$table1 =  $table1."<td>".$kW."</td>";
													$table1 =  $table1."<td>".$kVAh."</td>";
													$table1 =  $table1."<td>".truncate_number($max_pf_kva[1],3)."</td>";
													//$table1 =  $table1."<td>".$PowerFactor." (".$PowerFactor_Date.")</td>";
													$table1 =  $table1."<td>".$max_pf_kva[0]."</td>";

													$table1 =  $table1."<td>".$kWdaytotal."</td>";
													$table1 =  $table1."<td>".$kWnighttotal."</td>";
													}else{
													$table1 =  $table1."<td>".$kWh."</td>";
													//$table1 =  $table1."<td>".$kW."</td>";
													$table1 =  $table1."<td>".$kVAh."</td>";
													$table1 =  $table1."<td>0</td>";
													//$table1 =  $table1."<td>".$PowerFactor." (".$PowerFactor_Date.")</td>";
													$table1 =  $table1."<td>0</td>";
													$table1 =  $table1."<td>".$kWdaytotal."</td>";
													$table1 =  $table1."<td>".$kWnighttotal."</td>";
													}

													$table1 =  $table1."</tr>";

													if($kcnt==0){
															$combokWkey =  "'".$query_period[$i]."'";
															$combokWdaytotal =  $kWdaytotal;
															$combokWnighttotal =  $kWnighttotal;
													}else{
															$combokWkey =  $combokWkey.",'".$query_period[$i]."'";
															$combokWdaytotal =  $combokWdaytotal.",".$kWdaytotal;
															$combokWnighttotal =  $combokWnighttotal.",".$kWnighttotal;
													}

													$kcnt++;

											}//ForLoop END
											$table1 =  $table1."</tbody></table>";
											echo $table1;



																	$graphcombo= "<script type=\"text/javascript\">
																		$(function () {
																	$('#container5555').egscharts({
																		chart: {
																			type: 'column'
																		},
																		title: {
																			text: ''
																		},
																		xAxis: {
																			categories: [".$combokWkey."]
																		},
																		yAxis: {
																			min: 0,
																			title: {
																				text: 'Total Day and Night consumption'
																			},
																			stackLabels: {
																				enabled: true,
																				style: {
																					fontWeight: 'bold',
																					color: (egscharts.theme && egscharts.theme.textColor) || 'gray'
																				}
																			}
																		},
																		legend: {
																			align: 'right',
																			x: -30,
																			verticalAlign: 'top',
																			y: 25,
																			floating: true,
																			backgroundColor: (egscharts.theme && egscharts.theme.background2) || 'white',
																			borderColor: '#CCC',
																			borderWidth: 1,
																			rotation: -90,
																			shadow: false
																		},
																		tooltip: {
																			formatter: function () {
																				return '<b>' + this.x + '</b><br/>' +
																					this.series.name + ': ' + this.y + '<br/>' +
																					'Total: ' + this.point.stackTotal;
																			}
																		},
																		plotOptions: {
																			column: {
																				stacking: 'normal',
																				dataLabels: {
																					enabled: true,
																					rotation: -90,
																					color: (egscharts.theme && egscharts.theme.dataLabelsColor) || 'white',
																					style: {
																						textShadow: '0 0 0px black'
																					}
																				}
																			}
																		},
																		series: [{
																					name: 'kWh Day',
																					data: [".$combokWdaytotal."]
																				}, {
																					name: 'kWh Night',
																					data: [".$combokWnighttotal."]
																				}]
																			});
																		});
																				</script>";

																		echo $graphcombo;




											$graph3= $graph3."],
												dataLabels: {
													enabled: true,
													rotation: -90,
													color: '#FFFFFF',
													align: 'right',
													format: '{point.y:.1f}', // one decimal
													y: 10, // 10 pixels down from the top
													style: {
														fontSize: '11px',
														fontFamily: 'Verdana, sans-serif'
													}
												}
											}]
											});
											});
											</script>";

											echo $graph3;


										}//End if





							?>


							<div id="container5555" style="min-width: 310px; height: 500px;"></div>

				</div>
			</div>
		</div>
	</div>

   <?php } ?>
