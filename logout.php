<?php
session_start();

// Hancurkan semua data sesi
session_destroy();

// Keluar dengan status 200 (OK)
http_response_code(200);
?>