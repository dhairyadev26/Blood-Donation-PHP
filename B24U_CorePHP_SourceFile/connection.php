<?php
/**
 * Database Connection Configuration
 * 
 * This file establishes a connection to the MySQL database for the 
 * B24U Blood Donation Management System.
 * 
 * Database Configuration:
 * - Host: localhost (change for production)
 * - Username: root (change for production)
 * - Password: empty (set password for production)
 * - Database: b24u
 * 
 * @package B24U
 * @version 1.0.0
 * @author Original: Smit Shah
 */

// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "b24u";

// Establish database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to UTF-8 for proper character handling
mysqli_set_charset($conn, "utf8");
?>