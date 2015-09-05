<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Database Emisi Udara</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			
			<ul id="navigation">
				<li>
					<a href="index.html">Home</a>
				</li>
				<li>
					<a href="map.html">Map</a>
				</li>
				<li class="active">
					<a href="data.html">Data</a>
				</li>
				<li>
					<a href="about.html">About the inventory</a>
				</li>
				<li>
					<a href="contact.html">Contact</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<div class="main">
			<h1>Database emisi udara</h1>
			<ul class="news">
		
<p>
Simpan Metadata:<br />
<form action="insert_meta.php" method="post">
Metode Perhitungan Emisi<br />
<select name="metode">
<option value="">---Pilih Data---</option>
<option value="bottom up">Bottom Up</option>
<option value="top down">Top Down</option>
</select><br />

Sumber Emisi<br />
<input type="text" name="sumber_e" size="20" maxlength="40" value="" /><br />

Objek<br />
<input type="text" name="objek" size="20" maxlength="40" value="" /><br />

Tahun<br />
<input type="int" name="tahun" size="20" maxlength="40" value="" /><br />
<input type="submit" value="Simpan!" />
</form>
</p>
<?php
include "db.inc.php";

$metode=$_POST['metode'];
$sumber=$_POST['sumber_e'];
$objek=$_POST['objek'];
$tahun=$_POST['tahun'];

if ($metode<>''){
$sql1="INSERT INTO metadata (metode, sumber, keterangan, tahun) values('$metode', '$sumber', '$objek', '$tahun');";
$hasil1=pg_exec($dbh, $sql1);
echo "Data berhasil dimasukan";
}
?>
		
			</ul>
		</div>
		<div class="sidebar">
			<h1>Aplikasi emisi udara</h1>
			<ul class="posts">
				<li>
					<h4 class="title"><a href="data_query.php">Query </a></h4>
					<p>
					</p>
				</li>
				<li>
					<h4 class="title">Tambah data</a></h4>
					<p>
					<a href="insert_e_jalan.php">Emisi jalan <br />
					<a href="insert_meta.php">Metadata<a/>
					</p>
				</li>
				<li>
					<h4 class="title">Ubah data</a></h4>
					<p>
					<a href="view_e_jalan.php">Emisi jalan <br />
					<a href="view_meta.php">Metadata<a/>
					</p>
				</li>
			</ul>
		</div>
	</div>
	<div id="footer">
		<div class="clearfix">
			<p>
				<center>Web GIS Emisi Udara Kota Bandung.
			</p>
		</div>
	</div>
</body>
</html>