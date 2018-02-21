<?php
//load the database configuration file
include 'dbConfig.php';

if(isset($_POST['importSubmit'])){
    
    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            //skip first line
            fgetcsv($csvFile);
            
            //parse data from csv file line by line
			//echo "<br>Before";
			$icnt = 1;
			$rvolt=0;
			$yvolt=0;
			$bvolt=0;
			
			$rcurr=0;
			$ycurr=0;
			$bcurr=0;
			$rangle=0;
			$yangle=0;
			$bangle=0;
			$rkw=0;
			$ykw=0;
			$bkw=0;
			$rkvar=0;
			$ykvar=0;
			$bkvar=0;
			$rkva=0;
			$ykva=0;
			$bkva=0;
			$kw=0;
			$kvar=0;
			$kva=0;
			$pf=0;
			$frequency=0;
			$meternum=0;
			$statusdate="";
			
			
			$rpf=0;
			$ypf=0;
			$bpf=0;
			$netpf=0;
			$frequency=0;

            while(($line = fgetcsv($csvFile)) !== FALSE){
				//echo "<br>".$icnt."~~~~~~".$line[0]."<------>".$line[1]."<----------->".$line;
            
			  if(substr( $_FILES['file']['name'], 0, -4) == "3021632"){
				  
				if($icnt==1){
					$rvolt = substr( $line[1], 0, -1);
					//echo "<br>".$rvolt.$line;
				}
				
				if($icnt==2){
					$yvolt = substr( $line[1], 0, -1);
					//echo "<br>".$yvolt.$line;
				}
			
				if($icnt==3){
					$bvolt = substr( $line[1], 0, -1);
					//echo "<br>".$bvolt.$line;
				}
			
				if($icnt==4){
					$rcurr = substr( $line[1], 0, -1);
					//echo "<br>".$rcurr.$line;
				}
				
				if($icnt==5){
					$ycurr = substr( $line[1], 0, -1);
					//echo "<br>".$ycurr.$line;
				}
				
				if($icnt==6){
					$bcurr = substr( $line[1], 0, -1);
					//echo "<br>".$bcurr.$line;
				}
				

		

				if($icnt==13){
					$rpf = $line[1];
					$rpf = abs($rpf);
					$rangle = round(rad2deg(acos($rpf)),4);
					
					$rkw=round(($rvolt * $rcurr) * ($rpf),4);
					$rkvar= round($rvolt * $rcurr * sin(deg2rad($rangle)),4);
					$rkva=round($rvolt * $rcurr,4);
					//echo "<br>".$rpf."<---->".$rangle."<------->".$rkw."<####>".$rkvar."#####".round(sin(deg2rad($rangle)),4)."~~~~~~~~~~~~~~".$line;
				}
				
				if($icnt==14){
					$ypf = $line[1];
					$ypf = abs($ypf);
					$ykw=round(($yvolt * $ycurr) * ($ypf),4);
					$yangle = round(rad2deg(acos($ypf)),4);
					
					$ykvar= round(($yvolt * $ycurr * sin(deg2rad($yangle))),4);
					$ykva=round($yvolt * $ycurr,4);
					//echo "<br>".$ypf."<---->".$yangle."<------->".$ykw."<####>".$ykvar."#####".$line;
				}
				
				if($icnt==15){
					$bpf = $line[1];
					$bpf = abs($bpf);
					$bkw=round(($bvolt * $bcurr * $bpf),4);
					$bangle = round(rad2deg(acos($bpf)),4);
					$bkvar= round($bvolt * $bcurr * sin(deg2rad($bangle)),4);
					$bkva=round($bvolt * $bcurr,4);
					
					$kw=$rkw+$ykw+$bkw;
					$kvar=$rkvar+$ykvar+$bkvar;
					$kva=$rkva+$ykva+$bkva;
					
					//echo "<br>".$bpf."<---->".$bangle."<------->".$bkw."@".$bvolt."@".$bcurr."@"."<####>".$bkvar."#####".$bpf."#1#".$kw."#2#".$kvar."#3#".$kva.$line;
				}
				
				if($icnt==16){
					$netpf = $line[1];
					//echo "<br>".$netpf.$line;
				}
				
				if($icnt==17){
					$frequency = substr( $line[1], 0, -2);
					//echo "<br>".$frequency.$line;
				}
			
				if($icnt==22){
					$statusdate = substr( $line[1], 0, -17);
					//echo "<br>".$statusdate.$line;
				}
			  }else{
			
				if($icnt==1){
					$rvolt = substr( $line[1], 0, -1);
					//echo "<br>".$rvolt.$line;
				}
				
				if($icnt==2){
					$yvolt = substr( $line[1], 0, -1);
					//echo "<br>".$yvolt.$line;
				}
			
				if($icnt==3){
					$bvolt = substr( $line[1], 0, -1);
					//echo "<br>".$bvolt.$line;
				}
			
				if($icnt==4){
					$rcurr = substr( $line[1], 0, -1);
					//echo "<br>".$rcurr.$line;
				}
				
				if($icnt==5){
					$ycurr = substr( $line[1], 0, -1);
					//echo "<br>".$ycurr.$line;
				}
				
				if($icnt==6){
					$bcurr = substr( $line[1], 0, -1);
					//echo "<br>".$bcurr.$line;
				}
				

		

				if($icnt==7){
					$rpf = $line[1];
					$rpf = abs($rpf);
					$rangle = round(rad2deg(acos($rpf)),4);
					
					$rkw=round(($rvolt * $rcurr) * ($rpf),4);
					$rkvar= round($rvolt * $rcurr * sin(deg2rad($rangle)),4);
					$rkva=round($rvolt * $rcurr,4);
					//echo "<br>".$rpf."<---->".$rangle."<------->".$rkw."<####>".$rkvar."#####".round(sin(deg2rad($rangle)),4)."~~~~~~~~~~~~~~".$line;
				}
				
				if($icnt==8){
					$ypf = $line[1];
					$ypf = abs($ypf);
					$ykw=round(($yvolt * $ycurr) * ($ypf),4);
					$yangle = round(rad2deg(acos($ypf)),4);
					
					$ykvar= round(($yvolt * $ycurr * sin(deg2rad($yangle))),4);
					$ykva=round($yvolt * $ycurr,4);
					//echo "<br>".$ypf."<---->".$yangle."<------->".$ykw."<####>".$ykvar."#####".$line;
				}
				
				if($icnt==9){
					$bpf = $line[1];
					$bpf = abs($bpf);
					$bkw=round(($bvolt * $bcurr * $bpf),4);
					$bangle = round(rad2deg(acos($bpf)),4);
					$bkvar= round($bvolt * $bcurr * sin(deg2rad($bangle)),4);
					$bkva=round($bvolt * $bcurr,4);
					
					$kw=$rkw+$ykw+$bkw;
					$kvar=$rkvar+$ykvar+$bkvar;
					$kva=$rkva+$ykva+$bkva;
					
					//echo "<br>".$bpf."<---->".$bangle."<------->".$bkw."@".$bvolt."@".$bcurr."@"."<####>".$bkvar."#####".$bpf."#1#".$kw."#2#".$kvar."#3#".$kva.$line;
				}
				
				if($icnt==10){
					$netpf = $line[1];
					//echo "<br>".$netpf.$line;
				}
				
				if($icnt==11){
					$frequency = substr( $line[1], 0, -2);
					//echo "<br>".$frequency.$line;
				}
			
				if($icnt==17){
					$statusdate = substr( $line[1], 0, -17);
					//echo "<br>".$statusdate.$line;
				}
			
			  }
				
				$icnt++;
            }
			
			//check whether member already exists in database with same email
                $prevQuery = "SELECT meternum FROM fi_meter_status WHERE meternum = ".substr( $_FILES['file']['name'], 0, -4)." and datentime="."STR_TO_DATE('".$statusdate."', '%d/%m/%Y %H:%i')";
				//echo "<br>".$prevQuery;
                $prevResult = $db->query($prevQuery);
                if($prevResult->num_rows > 0){
                    //update member data
                    ////\$db->query("UPDATE members SET name = '".$line[0]."', phone = '".$line[2]."', created = '".$line[3]."', modified = '".$line[3]."', status = '".$line[4]."' WHERE email = '".$line[1]."'");
                }else{
                    //insert member data into database
					
					$insert_query="INSERT IGNORE INTO fi_meter_status (meternum, rvolt, yvolt, bvolt, rcurr, ycurr, bcurr, rangle, yangle, bangle, rkw, ykw, bkw, rkvar, ykvar, bkvar, rkva, ykva, bkva, kw, kvar, kva, pf, frequency, datentime) VALUES
							(".substr( $_FILES['file']['name'], 0, -4).",".$rvolt.",".$yvolt.",".$bvolt.",".$rcurr.",".$ycurr.",".$bcurr.",".$rangle.",".$yangle.",".$bangle.",".$rkw.",".$ykw.",".$bkw.",".$rkvar.",".$ykvar.",".$bkvar.",".$rkva.",".$ykva.",".$bkva.",".$kw.",".$kvar.",".$kva.",".$netpf.",".$frequency.",STR_TO_DATE('".$statusdate."', '%d/%m/%Y %H:%i'))";
					//echo "<br>".$insert_query;
                    $db->query($insert_query);
                }
				
			
			
            //echo "<br>After";
            //close opened csv file
            fclose($csvFile);
//$qstring = '?status=err';
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: index.php".$qstring);