<?php
$konek="host=localhost dbname=Emisi user=postgres password=postgres";
$dbh = pg_connect($konek);
if(!$dbh){
	echo "koneksi ke database tidak berhasil<br><br>";
}
?>