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
				echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">No Customer Name Selected</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">No Meter Number Selected</span>)";
		    }
	?>
	</h1>
</div>
<?php

if(!empty($this->session->userdata('meter_number'))){

  ?>



SELECT Min(pf) AS minimum_value,
       Max(pf) AS maximum_value,
       Avg(pf) AS average_value
  FROM fi_meter_status
  where meternum=211423686





<style type="text/css">

			table.gridtable {
				font-family: verdana,arial,sans-serif;
				font-size:14px;
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

<div class="container-fluid">
    <div class="row-fluid">
		<div class="widget">


			<div class="widget-title">
				<h5><?php echo lang('status'); ?></h5>
			</div>

			<table class="gridtable" cellspacing="10" cellpadding="10" border=1 align="center" >
			    <caption>
			   		Status on kW, KvA & PF
			    </caption>
			    <colgroup>
			    <col class="col1"/>
			    <col  />
			    <col />
			    <col  />
			    </colgroup>
			    <tr>
			        <th>Parameters</th>
			        <th>kW</th>
			        <th>KvA</th>
			        <th>PF</th>
			    </tr>
			    <tr class="col2">
			    	<td align="center">Highest</td>
			        <td align="center"></td>
			        <td align="center"></td>
			        <td align="center"></td>
			    </tr>
			    <tr class="col3">
			    	<td align="center">Average</td>
			        <td align="center"></td>
			        <td align="center"></td>
			        <td align="center"></td>
			    </tr>
			    <tr class="col4">
			    	<td align="center">Lowest</td>
			        <td align="center"></td>
			        <td align="center"></td>
			        <td align="center"></td>
			     </tr>
			</table>


			</div>
			</div>
			</div>



			</body>

<?php } ?>
