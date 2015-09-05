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
		
<table border=6>
<tr>
	<td align=center ><h4>Form Edit Data Emisi Udara</h4>
	</td></tr>
	<tr>
		<td>
			<table bgcolor="#EEEEEE">

<?php
include "db.inc.php";
$id_emisi = $_GET['id_emisi'];
$sql="SELECT * FROM emisi_jln WHERE id_emisi='$id_emisi'";
$hasil=pg_exec($dbh,$sql);
$row=pg_fetch_array($hasil);
?>

<form method="POST" action="">
<tr>
	<input type="hidden" name="id_emisi" value="<? echo $row['id_emisi']?>">
	<tr><td>Jenis Emisi</td><td><input type=text name=jenis_e value="<? echo"$row[jenis_e]"?>"></td></tr>
<tr><td>Nilai Emisi</td><td><input type=text name=nilai_e value="<? echo"$row[nilai_e]"?>"></td></tr>
<tr><td>ID Jalan</td><td><input type=text name=id_jln value="<? echo"$row[id_jln]"?>"></td></tr>
<tr><td>ID Metadata</td><td><input type=text name=id_me value="<? echo"$row[id_me]"?>"></td></tr>
<tr>
<td><td/>
<td align=right><br><input type=submit name=submit value=SIMPAN></td>
</table>
</td>
</tr>
</table>
<?php
if(isset($_POST['submit'])){
$hasil = pg_query("UPDATE emisi_jln SET jenis_e='".$_POST['jenis_e']."', nilai_e='".$_POST['nilai_e']."', id_jln='".$_POST['id_jln']."' where id_emisi='".$_POST['id_emisi']."'");
if($hasil){

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

echo '<head>
	<meta http-equiv="refresh" content="3, URL=view_e_jalan.php">
	</meta>
	
	
	<center><p><font size=4>Data berhasil diubah</p></font>';
}
else{
 echo "<hr><br/><b>Data Gagal Diubah</b>";
}
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