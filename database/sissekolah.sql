CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,

    nama VARCHAR(150) NOT NULL,

    username VARCHAR(50) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    role ENUM(
        'superadmin',
        'kepsek',
        'sdm',
        'guru',
        'staff',
        'siswa'
    ) NOT NULL,

    status ENUM(
        'aktif',
        'nonaktif'
    ) DEFAULT 'aktif',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);