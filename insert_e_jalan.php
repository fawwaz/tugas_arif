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
Simpan Nilai Emisi Udara Jalan:<br />
<form action="insert_e_jalan.php" method="post">
Jenis Emisi:<br />
<input type="text" name="jenis" size="20" maxlength="40" value="" /><br />
Nilai Emisi:<br />
<input type="text" name="nilai" size="20" maxlength="40" value="" /><br />
Nama Jalan:<br />
<?php
include "db.inc.php";
?>
<select name="nama">
<option value="">---Pilih Data---</option>
<?php
$sql="SELECT * FROM jalan";
$hasil=pg_exec($dbh,$sql);
while ($row1 = pg_fetch_array($hasil)){
	echo "<option value='".$row1['id_jln']."'>".$row1['nama']."</option>";
}
?>
</select>

<br />ID Metadata<br />
<select name="id_me">
<option value="">---Pilih Data---</option>
<?php
$sql="SELECT * FROM metadata";
$hasil=pg_exec($dbh,$sql);
while ($row1 = pg_fetch_array($hasil)){
	echo "<option value='".$row1['id_me']."'>".$row1['id_me']."</option>";
}
?>
</select>
<br />
<input type="submit" value="Simpan!" />
</form>
</p>

<?php
$jenis=$_POST['jenis'];
$nilai=$_POST['nilai'];
$id_jln=$_POST['nama'];
$id_me=$_POST['id_me'];

if ($jenis<>''){
$sql1="INSERT INTO emisi_jln (jenis_e, nilai_e, id_jln, id_me) values('$jenis', '$nilai', '$id_jln', '$id_me');";
$hasil1=pg_exec($dbh, $sql1);
echo "Data berhasil dimasukan";
}

if($hasil1){
$sql2="DELETE FROM emisi_grid";
$sql2="
INSERT INTO
	emisi_grid(id_grid, jenis, nilai, id_me)
SELECT
	id_grid,
	jenis_e,
	sum(emisi_jln.nilai_e * lookup.bobot),
	id_me
FROM
	emisi_jln,
	lookup
WHERE
	emisi_jln.id_jln = lookup.id_jln
GROUP BY
	id_grid, jenis_e, id_me
ORDER BY
	id_grid, jenis_e, id_me";
$hasil2=pg_exec($dbh, $sql2);	
}
else{
	echo "";
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