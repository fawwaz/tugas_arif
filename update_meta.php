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
	<td align=center ><h4>Form Edit Metadata</h4>
	</td></tr>
	<tr>
		<td>
			<table bgcolor="#EEEEEE">

<?php
include "db.inc.php";
$id_me = $_GET['id_me'];
$sql="SELECT * FROM metadata WHERE id_me='$id_me'";
$hasil=pg_exec($dbh,$sql);
$row=pg_fetch_array($hasil);
?>

<form method="POST" action="">
<tr>
	<input type="hidden" name="id_me" value="<? echo $row['id_me']?>">
	<td>Metode</td><td><input type=text name=metode value="<? echo"$row[metode]"?>"></td></tr>
<tr><td>Sumber</td><td><input type=text name=sumber value="<? echo"$row[sumber]"?>"></td></tr>
<tr><td>Keterangan</td><td><input type=text name=objek value="<? echo"$row[keterangan]"?>"></td></tr>
<tr><td>Tahun</td><td><input type=text name=tahun value="<? echo"$row[tahun]"?>"></td></tr>
<tr>
<td><td/>
<td align=right><br><input type=submit name=submit value=SIMPAN></td>
</table>
</td>
</tr>
</table>
<?php
if(isset($_POST['submit'])){
$hasil = pg_query("UPDATE metadata SET metode='".$_POST['metode']."', sumber='".$_POST['sumber']."', keterangan='".$_POST['objek']."', tahun='".$_POST['tahun']."' where id_me='".$_POST['id_me']."'");
if($hasil){
 echo '<head>
	<meta http-equiv="refresh" content="3, URL=view_meta.php">
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