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
				Choose the table:<br />
<form action="data_query.php" method="post">
Field:<br />
<select name="field">
 <option value="">---Pilih Tabel---</option>
 <option value="e_jalan">Emisi Jalan</option>
 <option value="e_grid">Emisi Grid</option>
 <option value="jln">Jalan Kota Bandung</option>
 <option value="meta">Metadata</option>
 </select>
<input type="submit" value="View" />
<br />
<br />
<?php
 /* If the form has been submitted with a supplied keyword */
 if (isset($_POST['field'])){
 include "pgsql.class.php";
 /* Connect to server and select database */
 $pgsqldb = new pgsql("localhost","Emisi","postgres","postgres");
 $pgsqldb->connect();
 /* Set the posted variables to a convenient name */
  $field = $_POST['field'];
 /* Create the query */
 if ($field == "e_jalan") {
 $pgsqldb->query('SELECT emisi_jln.id_emisi AS "ID Emisi", emisi_jln.jenis_e AS "Jenis Emisi", emisi_jln.nilai_e AS "Nilai Emisi", jalan.nama AS "Nama Jalan", metadata.metode AS "Metode", metadata.sumber AS "Sumber", metadata.tahun AS "Tahun" 
				FROM emisi_jln, jalan, metadata
				WHERE jalan.id_jln = emisi_jln.id_jln AND metadata.id_me = emisi_jln.id_me
				ORDER BY id_emisi');
 }
 elseif ($field == "e_grid") {
 $pgsqldb->query('DELETE FROM emisi_grid');
 $pgsqldb->query('
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
	id_grid, jenis_e, id_me');
 $pgsqldb->query('SELECT id_grid AS "ID Grid", jenis AS "Jenis", nilai AS "Nilai", id_me AS "ID Metadata" FROM emisi_grid ORDER BY id_grid');
 }
 elseif ($field == "jln") {
 $pgsqldb->query('SELECT nama AS "Nama Jalan", pjg_jln AS "Panjang Jalan" FROM jalan ORDER BY id_jln');
 }
 elseif ($field == "meta") {
 $pgsqldb->query('SELECT id_me AS "ID Metadata", metode AS "Metode", sumber AS "Sumber", objek AS "Keterangan", tahun AS "Tahun"
 FROM metadata ORDER BY id_me');
 }
 echo $pgsqldb->getResultAsTable();
 }
 
?>
</form>
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
					<a href="insert_meta.php">Metadata
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