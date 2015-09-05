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

					<table border="1" cellpading="0" cellspacing="0">
						<td><b>ID Emisi</td>
						<td><b>Jenis Emisi</td>
						<td><b>Nilai Emisi</td>
						<td><b>Nama Jalan</td>
						<td><b>Metode</td>
						<td><b>Sumber</td>
						<td><b>Tahun</td>
						<td><center><b>Pilihan</center></td></tr>

<?php
include "db.inc.php";

$sql="SELECT emisi_jln.id_emisi, emisi_jln.jenis_e, emisi_jln.nilai_e, jalan.nama, metadata.metode, metadata.sumber, metadata.tahun 
				FROM emisi_jln, jalan, metadata
				WHERE jalan.id_jln = emisi_jln.id_jln AND metadata.id_me = emisi_jln.id_me
				ORDER BY id_emisi";
$hasil=pg_exec($dbh,$sql);

while($data=pg_fetch_array($hasil)){
?>

<tr><td><?php echo $data['id_emisi']?></td>
<td><?php echo $data['jenis_e']?></td>
<td><?php echo $data['nilai_e']?></td>
<td><?php echo $data['nama']?></td>
<td><?php echo $data['metode']?></td>
<td><?php echo $data['sumber']?></td>
<td><?php echo $data['tahun']?></td>
<td><a href="update_e_jalan.php?id_emisi=<?php echo $data['id_emisi']?>">Edit</a> 
	<a href="delete_e_jalan.php?id_emisi=<?php echo $data['id_emisi']?>">Delete</a></font></td></tr>
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