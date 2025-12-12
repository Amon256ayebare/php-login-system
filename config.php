<?php
// Configuration - uses environment variables if present, otherwise falls back to the provided defaults.
// IMPORTANT: On Render set the environment variables DB_HOST, DB_NAME, DB_USER, DB_PASS in the service settings.

$DB_HOST = getenv('DB_HOST') ?: 'db4free.net';
$DB_NAME = getenv('DB_NAME') ?: 'amon';
$DB_USER = getenv('DB_USER') ?: 'amon';
$DB_PASS = getenv('DB_PASS') ?: '123';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_errno) {
    error_log('DB connect error: ' . $mysqli->connect_error);
    die('Database connection failed. Check configuration.');
}

function esc($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
