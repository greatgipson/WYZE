<div class="headerbar">
    <h1> Client Name </h1>
</div>
<?php
	include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$varbmsid = $_POST['bmsid'];
	echo $varbmsid;

}
?>

<script type="text/javascript">
    window.onload = function() {
    //alert("dddd");
        document.forms['myForm'].addEventListener('change', function() {
            this.submit();
        }, true);
    };
</script>


<?php

  $query = "select client_id,client_name from fi_clients"; //SELECT id,cat FROM cat
  $result = mysql_query($query);

  $categories[] = array("id" => "", "val" => "");

  while($row = mysql_fetch_array($result)){
    $categories[] = array("id" => $row['client_id'], "val" => $row['client_name']);
  }



  $query = "select id,client_id,ip_address from fi_meters";
  $result = mysql_query($query);

	//$subcats[0][] = array("id" => 0, "val" => 0);
  while($row = mysql_fetch_array($result)){
    $subcats[$row['client_id']][] = array("id" => $row['id'], "val" => $row['ip_address']);
  }

  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);


?>

<!docytpe html>
<html>

  <head>
    <script type='text/javascript'>
      <?php
        echo "var categories = $jsonCats; \n";
        echo "var subcats = $jsonSubCats; \n";
      ?>
      function loadCategories(){
        var select = document.getElementById("categoriesSelect");
        select.onchange = updateSubCats;
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].val,categories[i].id);
        }
      }
      function updateSubCats(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("subcatsSelect");
        subcatSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < subcats[catid].length; i++){
          subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
        }
      }
    </script>

  </head>

  <body onload='loadCategories()'>
    <select id='categoriesSelect'>
    </select>
<form id="myForm" method="POST">
    <select id='subcatsSelect' name=bmsid onchange="document.forms['changebmsid'].submit()">
    </select>
</form>
  </body>
</html>

<div class="container-fluid">
    <div class="row-fluid">
            <div class="widget">
	            <div class="widget-title">
	                <h5><?php echo lang('dashboard'); ?></h5>
               </div>

				<div id="powerfactor4weeks1"></div>
 			</div>
    </div>
</div>