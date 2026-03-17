<?php
/*error_reporting(E_ALL);
ini_set('display error',1);*/

// Prefer environment-driven settings, then try project defaults.
$dbHost = getenv('PGHOST') ?: 'localhost';
$dbPort = getenv('PGPORT') ?: '5432';
$envDbName = getenv('PGDATABASE') ?: '';
$dbCandidates = $envDbName !== '' ? array($envDbName) : array('online_farm', 'postgres');

$credentialCandidates = array(
    array(
        'user' => getenv('PGUSER') ?: '',
        'pass' => getenv('PGPASSWORD') ?: ''
    ),
    array('user' => 'tybcs', 'pass' => 'msgcs'),
    array('user' => 'postgres', 'pass' => 'postgres123'),
    array('user' => 'postgres', 'pass' => 'postgres'),
    array('user' => 'postgres', 'pass' => '')
);

$con = false;
foreach ($dbCandidates as $dbName) {
    foreach ($credentialCandidates as $candidate) {
        if ($candidate['user'] === '') {
            continue;
        }

        $connStr = sprintf(
            "host=%s port=%s dbname=%s user=%s password=%s connect_timeout=2",
            $dbHost,
            $dbPort,
            $dbName,
            $candidate['user'],
            $candidate['pass']
        );

        $con = @pg_connect($connStr);
        if ($con) {
            break 2;
        }
    }
}

if (!$con) {
    die(
        "Database connection failed. " .
        "Start PostgreSQL and verify host/port/credentials. " .
        "Current target: {$dbHost}:{$dbPort}."
    );
}
?>
