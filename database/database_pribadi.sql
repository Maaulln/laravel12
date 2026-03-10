-- ============================================================
-- DATABASE: pribadi
-- Laravel 10 Portfolio + Send Message Feature
-- Jalankan file ini di phpMyAdmin atau MySQL CLI:
--   mysql -u root < database/database_pribadi.sql
-- ============================================================

-- Buat database
CREATE DATABASE IF NOT EXISTS `pribadi`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `pribadi`;

-- ============================================================
-- 1. Tabel migrations (tracking migrasi Laravel)
-- ============================================================
CREATE TABLE IF NOT EXISTS `migrations` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `migration` VARCHAR(255) NOT NULL,
    `batch` INT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 2. Tabel users (autentikasi pengguna)
-- ============================================================
CREATE TABLE IF NOT EXISTS `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 3. Tabel password_reset_tokens (reset password)
-- ============================================================
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 4. Tabel failed_jobs (antrian job gagal)
-- ============================================================
CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(255) NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 5. Tabel personal_access_tokens (Laravel Sanctum API)
-- ============================================================
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `tokenable_type` VARCHAR(255) NOT NULL,
    `tokenable_id` BIGINT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `token` VARCHAR(64) NOT NULL,
    `abilities` TEXT NULL DEFAULT NULL,
    `last_used_at` TIMESTAMP NULL DEFAULT NULL,
    `expires_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 6. Tabel messages (fitur Send Message / Contact Form)
-- ============================================================
CREATE TABLE IF NOT EXISTS `messages` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL COMMENT 'Nama pengirim',
    `email` VARCHAR(255) NOT NULL COMMENT 'Email pengirim',
    `subject` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Subjek pesan (opsional)',
    `message` TEXT NOT NULL COMMENT 'Isi pesan',
    `is_read` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Status baca: 0=belum, 1=sudah',
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Insert data migrasi (agar Laravel tahu tabel sudah ada)
-- ============================================================
INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
    ('2014_10_12_000000_create_users_table', 1),
    ('2014_10_12_100000_create_password_reset_tokens_table', 1),
    ('2019_08_19_000000_create_failed_jobs_table', 1),
    ('2019_12_14_000001_create_personal_access_tokens_table', 1),
    ('2026_03_10_000000_create_messages_table', 1);

-- ============================================================
-- Contoh data (opsional, hapus jika tidak perlu)
-- ============================================================

-- Contoh user (password: "password")
-- INSERT INTO `users` (`name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
-- ('Maulana Chandra', 'maaullntech@gmail.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());

-- Contoh message
-- INSERT INTO `messages` (`name`, `email`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
-- ('John Doe', 'john@example.com', 'Hello!', 'Ini adalah pesan percobaan dari contact form.', 0, NOW(), NOW()),
-- ('Jane Smith', 'jane@example.com', 'Kolaborasi Project', 'Saya tertarik untuk berkolaborasi dalam project AI.', 0, NOW(), NOW());
