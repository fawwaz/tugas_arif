<!DOCTYPE html>
<html>
  <head>
    <title>Query Map</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
  </head>
  <body>
  
Pilih Emisi:<br />
<form action="query_map.php" method="post">

<table>
<tr>
<td>
Jenis Emisi:<br />
<select name="jenis">
<option value="">---Pilih Data---</option>
<?php
include "db.inc.php";

$sql="SELECT DISTINCT jenis FROM emisi_grid";
$hasil=pg_exec($dbh,$sql);
while ($row1 = pg_fetch_array($hasil)){
	echo "<option value='".$row1['jenis']."'>".$row1['jenis']."</option>";
}
?>
</select><br /></td>

<td>
ID Metadata<br />
<select name="id_me">
<option value="">---Pilih Data---</option>
<?php
$sql="SELECT * FROM metadata";
$hasil=pg_exec($dbh,$sql);
while ($row1 = pg_fetch_array($hasil)){
	echo "<option value='".$row1['id_me']."'>".$row1['metode'].", ".$row1['sumber'].", ".$row1['keterangan'].", ".$row1['tahun']."</option>";
}
?>
</select><br /></td>
</tr>

<tr><td>
<input type="submit" value="Simpan!" />
</form>
</p>
</td></tr>
</table>


<?php
$jenis=$_POST['jenis'];
$id_me=$_POST['id_me'];
?>
   
   
	<div id="footer">
		<div class="clearfix">
			
			<p>
				2023 Zerotype. All Rights Reserved.
			</p>
		</div>
	</div>
  </body>
</html>