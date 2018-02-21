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
            while(($line = fgetcsv($csvFile)) !== FALSE){
                //check whether member already exists in database with same email
                $prevQuery = "SELECT id FROM fi_meter_data WHERE meternum = ".$line[1]." and dates="."STR_TO_DATE('".$line[0]."', '%d/%m/%Y %H:%i:%s')";
				echo "<br>".$prevQuery;
                $prevResult = $db->query($prevQuery);
                if($prevResult->num_rows > 0){
                    //update member data
                    ////\$db->query("UPDATE members SET name = '".$line[0]."', phone = '".$line[2]."', created = '".$line[3]."', modified = '".$line[3]."', status = '".$line[4]."' WHERE email = '".$line[1]."'");
                }else{
                    //insert member data into database
					if($line[1]=="3021632"){
						$insert_query="INSERT IGNORE INTO fi_meter_data (recordnum, dates, activewh, activevarh, activeva, stats, meternum) VALUES (666666,"."STR_TO_DATE('".$line[0]."', '%d/%m/%Y %H:%i:%s')".",".($line[8]*1000).",".($line[10]*1000).",".(($line[9]*2)*1000).",'',".$line[1].")";
					}else{
					$insert_query="INSERT IGNORE INTO fi_meter_data (recordnum, dates, activewh, activevarh, activeva, stats, meternum) VALUES (666666,"."STR_TO_DATE('".$line[0]."', '%d/%m/%Y %H:%i:%s')".",".($line[8]*1000).",".($line[10]*1000).",".($line[15]*1000).",'',".$line[1].")";
					}
					echo "<br>".$insert_query;
                    $db->query($insert_query);
                }
            }
            
            //close opened csv file
            fclose($csvFile);

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