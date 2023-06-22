<?php
session_start();

// Hapus semua variabel session
$_SESSION = array();

// Hapus cookie session jika ada
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Hancurkan session
session_destroy();

// Arahkan pengguna ke halaman login
header("Location: index.php");
exit();
