<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Main Route
$route['default_controller'] = 'admin/login';
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;

// Data JSON
$route['json/admin/list-kategori-produk'] = 'json/json_admin/list_kategori_produk';
$route['json/admin/get-kategori-produk'] = 'json/json_admin/get_kategori_produk';