<?php defined('BASEPATH') or die('Not direct access allowed');

/**
 * Genere le premier mot de passe par defaut
 * @return string mot de passe
 */
if (!function_exists('genPwd')) {
	function genPwd(): string {
		return substr(strtoupper(sha1(uniqid())), 0, 10);
	}
}

/**
 * Fonction permettant de hasher le mot de passe
 * @param string $pwd mot de passe a hashe ou proteger
 * @return string mot de passe crypte
 */
if (!function_exists('protectPwd')) {
	function protectPwd(string $pwd): string {
		return password_hash($pwd, PASSWORD_BCRYPT);
	}
}

/**
 * Fonction permettant de verifier la concordance des mots de passe hashe
 * @param string
 * @return bool
 */
if (!function_exists('runPwd')) {
	function runPwd(string $pwdToCheck, string $protectPwd): bool {return password_verify($pwdToCheck, $protectPwd);}
}
