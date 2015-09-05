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
		
<?php
include "db.inc.php";

$sql="SELECT * FROM metadata";
$hasil=pg_exec($dbh,$sql);
?>

<html>
<head>
<title>Lihat Data</title>
</head>
<body>
<table border="1" cellpading="0" cellspacing="0">
<td><b>ID Metadata</td>
<td><b>Metode</td>
<td><b>Sumber</td>
<td><b>Objek</td>
<td><b>Tahun</td>
<td><center><b>Pilihan</center></td></tr>

<?php
while($data=pg_fetch_array($hasil)){
?>

<tr><td><?php echo $data['id_me']?></td>
<td><?php echo $data['metode']?></td>
<td><?php echo $data['sumber']?></td>
<td><?php echo $data['keterangan']?></td>
<td><?php echo $data['tahun']?></td>
<td><a href="update_meta.php?id_me=<?php echo $data['id_me']?>">Edit</a> <a href="delete_meta.php?id_me=<?php echo $data['id_me']?>">Delete</a></font></td></tr>
<?php
}
?>
</table>
		
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