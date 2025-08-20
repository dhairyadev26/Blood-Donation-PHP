# B24U Blood Donation System - Technical Documentation

## Table of Contents
1. [System Architecture](#system-architecture)
2. [Database Schema](#database-schema)
3. [File Structure](#file-structure)
4. [API Endpoints](#api-endpoints)
5. [Security Implementation](#security-implementation)
6. [Email System](#email-system)
7. [Deployment Guide](#deployment-guide)

## System Architecture

### Overview
The B24U Blood Donation Management System follows a traditional LAMP stack architecture:

- **Linux/Windows**: Operating System
- **Apache**: Web Server
- **MySQL**: Database Management System
- **PHP**: Server-side scripting language

### Architecture Pattern
The system uses a procedural PHP approach with the following structure:

```
Frontend (HTML/CSS/JS) → PHP Scripts → MySQL Database
```

### Key Components

1. **Presentation Layer**: HTML5, CSS3, JavaScript
2. **Business Logic Layer**: Core PHP scripts
3. **Data Access Layer**: MySQL with mysqli extension
4. **Email Layer**: PHPMailer integration

## Database Schema

### Core Tables

#### 1. Donors Table
```sql
CREATE TABLE donors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    blood_type VARCHAR(5) NOT NULL,
    phone VARCHAR(15),
    address TEXT,
    date_of_birth DATE,
    last_donation DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 2. Blood Requests Table
```sql
CREATE TABLE blood_requests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    requester_name VARCHAR(100) NOT NULL,
    blood_type VARCHAR(5) NOT NULL,
    units_needed INT NOT NULL,
    urgency ENUM('low', 'medium', 'high') DEFAULT 'medium',
    hospital VARCHAR(100),
    contact_phone VARCHAR(15),
    status ENUM('pending', 'fulfilled', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 3. Events Table
```sql
CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_name VARCHAR(100) NOT NULL,
    organizer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    location VARCHAR(200) NOT NULL,
    description TEXT,
    status ENUM('upcoming', 'ongoing', 'completed') DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Relationships
- One-to-Many: Events → Event Participants
- One-to-Many: Donors → Donation History
- Many-to-Many: Donors ↔ Events (through participation table)

## File Structure

### Core PHP Files

#### Authentication Files
- `login_donor.php`: Donor authentication
- `login_event.php`: Event organizer authentication
- `registar_donor.php`: Donor registration
- `registar_event.php`: Event registration

#### Main Pages
- `index.php`: Homepage with featured content
- `about_us.php`: Information about the system
- `blood_tips.php`: Educational content for donors
- `get_in_touch.php`: Contact and feedback form

#### Functional Pages
- `request_blood.php`: Blood request form
- `pending_request.php`: View pending requests
- `donor_page.php`: Donor dashboard
- `event_status.php`: Event management dashboard
- `contribute.php`: Donation/contribution page

#### Utility Files
- `connection.php`: Database connection
- `header.php`: Common header component
- `footer.php`: Common footer component
- `process.php`: Form processing logic
- `sendemail.php`: Email functionality

### CSS Files Structure

```
CSS/
├── styleindex.css          # Homepage styling
├── styleaboutus.css        # About page styling
├── stylebloodtips.css      # Blood tips page styling
├── stylecontactus.css      # Contact page styling
├── stylecontribute.css     # Contribution page styling
├── styledonorentry.css     # Donor forms styling
├── styledonorhistory.css   # History page styling
├── styledonorpage.css      # Donor dashboard styling
├── styleeventstatus.css    # Event management styling
├── stylelogindonor.css     # Donor login styling
├── styleloginevent.css     # Event login styling
├── stylependingrequest.css # Requests page styling
├── styleregisterdonor.css  # Donor registration styling
├── styleregisterevent.css  # Event registration styling
├── stylerequestblood.css   # Blood request styling
└── styleupdatedonor.css    # Update forms styling
```

## API Endpoints

### Form Processing Endpoints

#### Donor Operations
- `POST /process.php?action=register_donor`: Register new donor
- `POST /process.php?action=login_donor`: Authenticate donor
- `POST /process.php?action=update_donor`: Update donor profile

#### Blood Request Operations
- `POST /process.php?action=request_blood`: Submit blood request
- `GET /pending_request.php`: View pending requests
- `POST /process.php?action=fulfill_request`: Mark request as fulfilled

#### Event Operations
- `POST /process.php?action=register_event`: Register new event
- `POST /process.php?action=login_event`: Authenticate event organizer
- `GET /event_status.php`: View event dashboard

#### Email Operations
- `POST /sendemail.php?action=send_otp`: Send OTP for verification
- `POST /sendemail.php?action=notify`: Send notifications

## Security Implementation

### 1. Input Validation
```php
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
```

### 2. Password Security
```php
// Password hashing during registration
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Password verification during login
if (password_verify($password, $hashed_password)) {
    // Login successful
}
```

### 3. SQL Injection Prevention
```php
// Use prepared statements
$stmt = $conn->prepare("SELECT * FROM donors WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
```

### 4. Session Management
```php
// Start secure sessions
session_start();
session_regenerate_id(true);

// Store user data in session
$_SESSION['donor_id'] = $donor_id;
$_SESSION['donor_email'] = $email;
```

## Email System

### PHPMailer Configuration

```php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// Server settings
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'your-email@gmail.com';
$mail->Password   = 'your-app-password';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;
```

### Email Templates

#### OTP Email
```php
function sendOTP($email, $otp) {
    $subject = "B24U - Email Verification OTP";
    $body = "
    <h2>Email Verification</h2>
    <p>Your OTP for email verification is: <strong>$otp</strong></p>
    <p>This OTP is valid for 10 minutes.</p>
    ";
    
    return sendEmail($email, $subject, $body);
}
```

#### Blood Request Notification
```php
function notifyBloodRequest($blood_type, $location) {
    $subject = "Urgent: Blood Request - $blood_type";
    $body = "
    <h2>Blood Donation Request</h2>
    <p>Blood Type Needed: <strong>$blood_type</strong></p>
    <p>Location: $location</p>
    <p>Please contact us if you can help.</p>
    ";
    
    return sendEmail($email, $subject, $body);
}
```

## Deployment Guide

### 1. Server Requirements

- **PHP**: 7.0 or higher
- **MySQL**: 5.7 or higher
- **Apache**: 2.4 or higher
- **Extensions**: mysqli, mbstring, openssl

### 2. Production Setup

#### a. File Permissions
```bash
# Set appropriate permissions
chmod 755 /var/www/html/B24U_CorePHP_SourceFile
chmod 644 /var/www/html/B24U_CorePHP_SourceFile/*.php
chmod 600 /var/www/html/B24U_CorePHP_SourceFile/connection.php
```

#### b. Apache Configuration
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /var/www/html/B24U_CorePHP_SourceFile
    
    <Directory /var/www/html/B24U_CorePHP_SourceFile>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/b24u_error.log
    CustomLog ${APACHE_LOG_DIR}/b24u_access.log combined
</VirtualHost>
```

#### c. SSL Configuration (Recommended)
```apache
<VirtualHost *:443>
    ServerName yourdomain.com
    DocumentRoot /var/www/html/B24U_CorePHP_SourceFile
    
    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    
    # Security headers
    Header always set X-Frame-Options DENY
    Header always set X-Content-Type-Options nosniff
    Header always set X-XSS-Protection "1; mode=block"
</VirtualHost>
```

### 3. Database Optimization

#### a. Indexing
```sql
-- Add indexes for better performance
CREATE INDEX idx_donors_email ON donors(email);
CREATE INDEX idx_donors_blood_type ON donors(blood_type);
CREATE INDEX idx_requests_blood_type ON blood_requests(blood_type);
CREATE INDEX idx_requests_status ON blood_requests(status);
```

#### b. Backup Strategy
```bash
# Daily backup script
#!/bin/bash
mysqldump -u username -p password b24u > /backup/b24u_$(date +%Y%m%d).sql
```

### 4. Monitoring and Logging

#### a. Error Logging
```php
// Enable error logging in production
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/php/b24u_errors.log');
```

#### b. Access Logging
```php
// Log user activities
function logActivity($user_id, $action, $details = '') {
    $log_entry = date('Y-m-d H:i:s') . " - User: $user_id - Action: $action - Details: $details\n";
    file_put_contents('/var/log/b24u/activity.log', $log_entry, FILE_APPEND);
}
```

## Performance Optimization

### 1. Database Optimization
- Use appropriate indexes
- Optimize queries
- Implement pagination for large datasets
- Use connection pooling

### 2. Caching Strategy
- Implement PHP OpCache
- Cache static content
- Use browser caching headers
- Consider Redis for session storage

### 3. Frontend Optimization
- Minify CSS and JavaScript
- Optimize images
- Use CDN for static assets
- Implement gzip compression

## Troubleshooting

### Common Issues

1. **Database Connection Errors**
   - Check database server status
   - Verify credentials in connection.php
   - Ensure MySQL service is running

2. **Email Sending Issues**
   - Verify SMTP settings
   - Check Gmail security settings
   - Ensure proper authentication

3. **Session Issues**
   - Check session save path permissions
   - Verify session configuration
   - Clear browser cookies

4. **File Upload Issues**
   - Check upload_max_filesize in php.ini
   - Verify directory permissions
   - Check disk space

For additional support, refer to the project repository or contact the development team.
