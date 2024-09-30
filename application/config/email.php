<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_user'] = 'uhqdev@gmail.com'; // Ganti dengan email Anda
$config['smtp_pass'] = 'wfrycofzybmwkvaj'; // Ganti dengan password email Anda
$config['smtp_port'] = 587;
$config['smtp_timeout'] = 7;
$config['smtp_crypto'] = 'tls';
$config['mailtype'] = 'html'; // Gunakan 'html' untuk email HTML
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";

