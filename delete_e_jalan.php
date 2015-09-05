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
			<div class="logo">
				<a href="index.html">Zero Type</a>
			</div>
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

$id_emisi=$_GET['id_emisi'];
$sql = "DELETE FROM emisi_jln WHERE id_emisi='$id_emisi'";
$hasil = pg_exec($sql);

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
	<body bgcolor="#andhie">
	
	<center><p><font size=4>Data berhasil dihapus</p></font>';
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
					<a href="view_meta.php">Metadata
					</p>
				</li>
			</ul>
		</div>
	</div>
	<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" class="facebook"></a><a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" class="googleplus"></a><a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" class="twitter"></a><a href="http://www.freewebsitetemplates.com/misc/contact/" target="_blank" class="tumbler"></a>
			</div>
			<p>
				© 2023 Zerotype. All Rights Reserved.
			</p>
		</div>
	</div>
</body>
</html>