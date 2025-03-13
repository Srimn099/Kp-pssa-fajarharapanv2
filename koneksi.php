<?php

//koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "panti");
if (!$koneksi) {
	die("Koneksi ke Database Gagal !");
}
