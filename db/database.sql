CREATE TABLE companies (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(200) NOT NULL,
    company_code VARCHAR(30) UNIQUE,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE sites (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_id INT UNSIGNED NOT NULL,
    site_name VARCHAR(150) NOT NULL,
    site_code VARCHAR(30),
    status TINYINT(1) DEFAULT 1,

    FOREIGN KEY (company_id)
    REFERENCES companies(id)
) ENGINE=InnoDB;

CREATE TABLE departments (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    department_name VARCHAR(150) NOT NULL,

    department_code VARCHAR(20),

    status TINYINT(1) DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB;

CREATE TABLE sub_departments (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    department_id INT UNSIGNED NOT NULL,

    sub_department_name VARCHAR(150) NOT NULL,

    sub_department_code VARCHAR(20),

    status TINYINT(1) DEFAULT 1,

    FOREIGN KEY (department_id)
    REFERENCES departments(id)

) ENGINE=InnoDB;

CREATE TABLE designations (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    designation_name VARCHAR(100) NOT NULL,

    designation_code VARCHAR(20),

    status TINYINT(1) DEFAULT 1

) ENGINE=InnoDB;

CREATE TABLE locations (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    site_id INT UNSIGNED NOT NULL,

    location_name VARCHAR(150),

    location_code VARCHAR(30),

    status TINYINT(1) DEFAULT 1,

    FOREIGN KEY(site_id)
    REFERENCES sites(id)

) ENGINE=InnoDB;

CREATE TABLE qualifications (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    qualification_name VARCHAR(100),

    status TINYINT(1) DEFAULT 1

) ENGINE=InnoDB;

CREATE TABLE roles (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    role_name VARCHAR(100),

    role_code VARCHAR(50),

    status TINYINT(1) DEFAULT 1

) ENGINE=InnoDB;

CREATE TABLE users (

    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    employee_id VARCHAR(30) UNIQUE NOT NULL,

    name VARCHAR(150) NOT NULL,

    username VARCHAR(100) UNIQUE NOT NULL,

    email VARCHAR(150) UNIQUE NOT NULL,

    mobile VARCHAR(15),

    department_id INT UNSIGNED NOT NULL,

    sub_department_id INT UNSIGNED NULL,

    designation_id INT UNSIGNED NOT NULL,

    location_id INT UNSIGNED NOT NULL,

    qualification_id INT UNSIGNED NULL,

    reporting_manager_id BIGINT UNSIGNED NULL,

    role_id INT UNSIGNED NOT NULL,

    joining_date DATE,

    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100)  NULL,

    digital_signature VARCHAR(255),

    signature_pin VARCHAR(255),

    status ENUM(
        'Active',
        'Inactive',
        'Locked',
        'Suspended'
    ) DEFAULT 'Active',

    failed_login_attempts INT DEFAULT 0,

    locked_until DATETIME NULL,

    last_login DATETIME NULL,

    last_login_ip VARCHAR(50),

    email_verified_at TIMESTAMP,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY(department_id)
        REFERENCES departments(id),

    FOREIGN KEY(sub_department_id)
        REFERENCES sub_departments(id),

    FOREIGN KEY(designation_id)
        REFERENCES designations(id),

    FOREIGN KEY(location_id)
        REFERENCES locations(id),

    FOREIGN KEY(role_id)
        REFERENCES roles(id),

    FOREIGN KEY(qualification_id)
        REFERENCES qualifications(id),

    FOREIGN KEY(reporting_manager_id)
        REFERENCES users(id)

) ENGINE=InnoDB;






/* ==========================================================
   COMPANIES
========================================================== */

INSERT INTO companies (company_name, company_code, status) VALUES
('ABC Pharmaceuticals Pvt. Ltd.', 'ABC', 1),
('LifeCare Pharma Ltd.', 'LCP', 1),
('MedPlus Healthcare', 'MPH', 1),
('BioGen Remedies', 'BGR', 1),
('CureWell Laboratories', 'CWL', 1);

/* ==========================================================
   SITES
========================================================== */

INSERT INTO sites (company_id, site_name, site_code, status) VALUES
(1, 'Ahmedabad Plant', 'AHD', 1),
(1, 'Vadodara Plant', 'VDR', 1),
(2, 'Surat Plant', 'SUR', 1),
(3, 'Rajkot Plant', 'RJT', 1),
(4, 'Gandhinagar Plant', 'GNR', 1);

/* ==========================================================
   DEPARTMENTS
========================================================== */

INSERT INTO departments (department_name, department_code, status) VALUES
('Quality Assurance', 'QA', 1),
('Quality Control', 'QC', 1),
('Production', 'PRD', 1),
('Engineering', 'ENG', 1),
('Human Resources', 'HR', 1);

/* ==========================================================
   SUB DEPARTMENTS
========================================================== */

INSERT INTO sub_departments (department_id, sub_department_name, sub_department_code, status) VALUES
(1, 'Documentation', 'DOC', 1),
(1, 'Validation', 'VAL', 1),
(2, 'Microbiology', 'MIC', 1),
(2, 'Chemical Analysis', 'CHEM', 1),
(3, 'Tablet Manufacturing', 'TAB', 1),
(3, 'Capsule Manufacturing', 'CAP', 1),
(4, 'Maintenance', 'MAIN', 1),
(5, 'Recruitment', 'REC', 1);

/* ==========================================================
   DESIGNATIONS
========================================================== */

INSERT INTO designations (designation_name, designation_code, status) VALUES
('System Administrator', 'SA', 1),
('QA Manager', 'QAM', 1),
('QA Executive', 'QAE', 1),
('QC Executive', 'QCE', 1),
('Production Officer', 'PO', 1);

/* ==========================================================
   LOCATIONS
========================================================== */

INSERT INTO locations (site_id, location_name, location_code, status) VALUES
(1, 'QA Office', 'QAO', 1),
(1, 'QC Laboratory', 'QCL', 1),
(2, 'Production Block', 'PB', 1),
(3, 'Warehouse', 'WH', 1),
(4, 'Administration', 'ADM', 1);

/* ==========================================================
   QUALIFICATIONS
========================================================== */

INSERT INTO qualifications (qualification_name, status) VALUES
('B.Pharm', 1),
('M.Pharm', 1),
('B.Sc', 1),
('M.Sc', 1),
('MCA', 1);

/* ==========================================================
   ROLES
========================================================== */

INSERT INTO roles (role_name, role_code, status) VALUES
('Super Admin', 'SUPER_ADMIN', 1),
('Administrator', 'ADMIN', 1),
('QA Manager', 'QA_MANAGER', 1),
('QA Executive', 'QA_EXECUTIVE', 1),
('Employee', 'EMPLOYEE', 1);

/* ==========================================================
   USERS
   Password = NULL
   Remember Token = NULL
========================================================== */

INSERT INTO users
(
employee_id,
name,
username,
email,
mobile,
department_id,
sub_department_id,
designation_id,
location_id,
qualification_id,
reporting_manager_id,
role_id,
joining_date,
password,
remember_token,
digital_signature,
signature_pin,
status,
failed_login_attempts,
locked_until,
last_login,
last_login_ip,
email_verified_at
)
VALUES
(
'EMP001',
'Super Admin',
'superadmin',
'superadmin@eqms.com',
'9876543210',
1,
1,
1,
1,
5,
NULL,
1,
'2024-01-01',
NULL,
NULL,
NULL,
NULL,
'Active',
0,
NULL,
NULL,
NULL,
NOW()
),
(
'EMP002',
'Rajesh Patel',
'rajesh',
'rajesh@eqms.com',
'9876543211',
1,
2,
2,
1,
2,
1,
3,
'2024-02-10',
'$2y$12$fEZKs.txeEqAD01uNzk5j.S2EG0CUT2qbDOzG40UYE.IKkSyXGlZK',
NULL,
NULL,
NULL,
'Active',
0,
NULL,
NULL,
NULL,
NOW()
),
(
'EMP003',
'Priya Shah',
'priya',
'priya@eqms.com',
'9876543212',
2,
3,
4,
2,
4,
2,
5,
'2024-03-15',
'$2y$12$fEZKs.txeEqAD01uNzk5j.S2EG0CUT2qbDOzG40UYE.IKkSyXGlZK',
NULL,
NULL,
NULL,
'Active',
0,
NULL,
NULL,
NULL,
NOW()
),
(
'EMP004',
'Amit Kumar',
'amit',
'amit@eqms.com',
'9876543213',
3,
5,
5,
3,
1,
2,
5,
'2024-04-20',
'$2y$12$fEZKs.txeEqAD01uNzk5j.S2EG0CUT2qbDOzG40UYE.IKkSyXGlZK',
NULL,
NULL,
NULL,
'Active',
0,
NULL,
NULL,
NULL,
NOW()
),
(
'EMP005',
'Neha Joshi',
'neha',
'neha@eqms.com',
'9876543214',
5,
8,
3,
5,
5,
2,
2,
'2024-05-10',
'$2y$12$fEZKs.txeEqAD01uNzk5j.S2EG0CUT2qbDOzG40UYE.IKkSyXGlZK',
NULL,
NULL,
NULL,
'Active',
0,
NULL,
NULL,
NULL,
NOW()
);