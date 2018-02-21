<div class="headerbar">
<h1>
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
	?>
	</h1>
</div>

  Voltage Failure
  Reverse Power
   Low Power Factor

