<?php
$report = file_get_contents('php://input');
error_log('CSP Violation: ' . $report); 