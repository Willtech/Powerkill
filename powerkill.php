#!/usr/bin/env php
<?php
/**
 * ============================================================
 *  POWERKILL — PHP Edition
 *  A ritualized signal storm utility
 * ============================================================
 *
 *  Usage:
 *      php powerkill.php <pid> [options]
 *
 *  Description:
 *      This program sends every possible signal (1–65536)
 *      to the given process ID. It is not optimized — by design.
 *      The inefficiency is deliberate, a ritual of excess:
 *      a storm of signals, valid or not, hurled at the target.
 *
 *  Options:
 *      -a, --all       Start from signal 0 (include sigspec 0)
 *      -h, --help      Show this help message
 *      -v, --version   Show version and credits
 *
 *  Credits:
 *      Original concept and shell script: Professor. Damian A. James Williamson Grad.
 *      PHP port and collaborative mythic overlay: Copilot (Microsoft AI)
 *
 *  Notes:
 *      • Requires PHP CLI with posix extension enabled for best results.
 *      • Falls back to system `kill` if posix_kill() is unavailable.
 *      • Use responsibly — this is a teaching artifact, not a production tool.
 *
 * ============================================================
 */

$VERSION = "Powerkill PHP 1.1";

// --- Argument parsing ---
if ($argc < 2) {
    fwrite(STDERR, "Usage: php powerkill.php <pid> [options]\n");
    exit(1);
}

$pid = null;
$startFromZero = false;
$timer = false;

// Parse arguments
foreach (array_slice($argv, 1) as $arg) {
    switch ($arg) {
        case "--timer":
             $timer = true;
             echo "Starting a timer.";
	     break;
        case "-h":
        case "--help":
            echo "Usage: php powerkill.php <pid> [options]\n";
            echo "Send every possible signal (1–65536) to the given PID.\n";
            echo "Options:\n";
            echo "  -a, --all       Start from signal 0 (include sigspec 0)\n";
            echo "  -h, --help      Show this help message\n";
            echo "  -v, --version   Show version and credits\n";
            exit(0);

        case "-v":
        case "--version":
            echo "$VERSION\n";
            echo "Original: Reaper Harvester / Willtech\n";
            echo "PHP port: Copilot (Microsoft AI)\n";
            exit(0);

        case "-a":
        case "--all":
            $startFromZero = true;
            break;

        default:
            if (is_numeric($arg)) {
                $pid = (int)$arg;
            } else {
                fwrite(STDERR, "Unknown option or invalid PID: $arg\n");
                exit(1);
            }
    }
}

if ($pid === null || $pid <= 0) {
    fwrite(STDERR, "Invalid or missing PID.\n");
    exit(1);
}

// --- The ritual storm ---
$start = $startFromZero ? 0 : 1;
for ($i = $start; $i <= 65536; $i++) {
    if (function_exists('posix_kill')) {
        @posix_kill($pid, $i);
    } else {
        @exec("kill -$i $pid 2>/dev/null");
    }
}

echo "Signal storm completed for PID $pid (starting from $start)\n";

if ($timer) {
    $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    echo "Did all that in $time Seconds.\r\n";
}

exit(0);
