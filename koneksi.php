<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualanhp");

if (!$koneksi) {
  die("Connection failed: " . mysqli_connect_error());
}
