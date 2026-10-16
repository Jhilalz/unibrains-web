<?php
// Lead-Handler für /arbeitgeber.html (PHP 5.6-kompatibel) — Anfrage an kontakt@unibrains.de.
function P($k){ return isset($_POST[$k]) ? $_POST[$k] : ''; }
function c($s){ return trim(str_replace(array("\r","\n"), ' ', (string)$s)); }
$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
if ($method !== 'POST') { header('Location: /arbeitgeber.html'); exit; }
if (c(P('website')) !== '') { header('Location: /arbeitgeber.html?sent=1#kontaktformular'); exit; } // Honeypot
$company = c(P('company'));
$name    = c(P('name'));
$email   = c(P('email'));
$phone   = c(P('phone'));
$prof    = c(P('profession'));
$count   = c(P('count'));
$message = substr(trim((string)P('message')), 0, 3000);
if ($company === '' || $name === '' || ($email === '' && $phone === '')) {
  header('Location: /arbeitgeber.html?err=1#kontaktformular'); exit;
}
$to = 'kontakt@unibrains.de';
$subject = '=?UTF-8?B?' . base64_encode('Neue Arbeitgeber-Anfrage: ' . $company) . '?=';
$body  = "Neue Anfrage über unibrains.de/arbeitgeber.html\n\n";
$body .= "Unternehmen:      $company\n";
$body .= "Ansprechpartner:  $name\n";
$body .= "E-Mail:           $email\n";
$body .= "Telefon/WhatsApp: $phone\n";
$body .= "Gesuchter Beruf:  $prof\n";
$body .= "Anzahl:           $count\n\n";
$body .= "Nachricht:\n$message\n";
$headers  = "From: Unibrains Website <kontakt@unibrains.de>\r\n";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) { $headers .= "Reply-To: $email\r\n"; }
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
@mail($to, $subject, $body, $headers);
header('Location: /arbeitgeber.html?sent=1#kontaktformular');
exit;
