<?php defined('BASEPATH') or die('No direct access allowed');

if (!function_exists('css_url')) {
	function css_url(string $nom) {
		return base_url()."assets/css/$nom.css";
	}
}

if (!function_exists('js_url')) {
	function js_url(string $nom) {
		return base_url()."assets/js/$nom.js";
	}
}

if (!function_exists('log_url')) {
	function log_url() {
		return base_url()."application/logs";
	}
}

if (!function_exists('img_url')) {
	function img_url(string $nom) {
		return base_url()."assets/img/".$nom;
	}
}

if (!function_exists('img')) {
	function img(string $nom, $alt = '') {
		return "<img src='".img_url($nom)."' alt='".$alt."'>";
	}
}
