<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Main Route
$route['default_controller'] = 'admin/login';
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;

// Data JSON
$route['json/admin/kategori-produk/list'] = 'json/admin/kategori_produk/list_kategori_produk';
$route['json/admin/kategori-produk/get'] = 'json/admin/kategori_produk/get_kategori_produk';

$route['json/admin/sub-kategori-produk/list'] = 'json/admin/kategori_produk/list_sub_kategori_produk';
$route['json/admin/sub-kategori-produk/get'] = 'json/admin/kategori_produk/get_sub_kategori_produk';