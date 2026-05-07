-- ============================================================
-- Sistem Rental Mobil Berbasis Web
-- Database Schema — MariaDB/MySQL 8.x Compatible
-- Engine: InnoDB (transactions + row-level locking)
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';

-- ============================================================
-- TABLE: users
-- ============================================================
CREATE TABLE IF NOT EXISTS `users` (
    `id`                BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(255)        NOT NULL,
    `email`             VARCHAR(255)        NOT NULL,
    `email_verified_at` TIMESTAMP           NULL DEFAULT NULL,
    `password`          VARCHAR(255)        NOT NULL,
    `role`              ENUM('admin','customer') NOT NULL DEFAULT 'customer',
    `is_active`         TINYINT(1)          NOT NULL DEFAULT 1,
    `profile_photo`     VARCHAR(500)        NULL DEFAULT NULL,
    `remember_token`    VARCHAR(100)        NULL DEFAULT NULL,
    `created_at`        TIMESTAMP           NULL DEFAULT NULL,
    `updated_at`        TIMESTAMP           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`),
    INDEX `users_role_index` (`role`),
    INDEX `users_is_active_index` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: password_reset_tokens
-- ============================================================
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
    `email`         VARCHAR(255) NOT NULL,
    `token`         VARCHAR(255) NOT NULL,
    `created_at`    TIMESTAMP    NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: vehicles
-- ============================================================
CREATE TABLE IF NOT EXISTS `vehicles` (
    `id`            BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `name`          VARCHAR(255)        NOT NULL,
    `type`          VARCHAR(100)        NOT NULL,
    `plate_number`  VARCHAR(20)         NOT NULL,
    `price_per_day` DECIMAL(12,2)       NOT NULL,
    `condition`     TEXT                NOT NULL,
    `avg_rating`    DECIMAL(3,2)        NOT NULL DEFAULT 0.00,
    `is_active`     TINYINT(1)          NOT NULL DEFAULT 1,
    `created_at`    TIMESTAMP           NULL DEFAULT NULL,
    `updated_at`    TIMESTAMP           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `vehicles_plate_number_unique` (`plate_number`),
    INDEX `vehicles_type_index` (`type`),
    INDEX `vehicles_price_per_day_index` (`price_per_day`),
    INDEX `vehicles_is_active_index` (`is_active`),
    INDEX `vehicles_is_active_type_price_index` (`is_active`, `type`, `price_per_day`),
    CONSTRAINT `vehicles_price_positive` CHECK (`price_per_day` > 0),
    CONSTRAINT `vehicles_avg_rating_range` CHECK (`avg_rating` >= 0.00 AND `avg_rating` <= 5.00)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: vehicle_photos
-- ============================================================
CREATE TABLE IF NOT EXISTS `vehicle_photos` (
    `id`            BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `vehicle_id`    BIGINT UNSIGNED     NOT NULL,
    `path`          VARCHAR(500)        NOT NULL,
    `is_360`        TINYINT(1)          NOT NULL DEFAULT 0,
    `sort_order`    SMALLINT UNSIGNED   NOT NULL DEFAULT 0,
    `created_at`    TIMESTAMP           NULL DEFAULT NULL,
    `updated_at`    TIMESTAMP           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    INDEX `vehicle_photos_vehicle_id_index` (`vehicle_id`),
    INDEX `vehicle_photos_vehicle_sort_index` (`vehicle_id`, `sort_order`),
    CONSTRAINT `fk_vehicle_photos_vehicle`
        FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: orders
-- Central table — state machine lives here
-- ============================================================
CREATE TABLE IF NOT EXISTS `orders` (
    `id`                    BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `order_code`            VARCHAR(20)         NOT NULL,
    `user_id`               BIGINT UNSIGNED     NOT NULL,
    `vehicle_id`            BIGINT UNSIGNED     NOT NULL,
    `start_date`            DATE                NOT NULL,
    `end_date`              DATE                NOT NULL,
    `total_price`           DECIMAL(12,2)       NOT NULL,
    `status`                ENUM(
                                'PENDING',
                                'PENDING_VERIFICATION',
                                'PAID',
                                'ACTIVE',
                                'COMPLETED',
                                'RATED',
                                'CANCELLED',
                                'REFUND_REQUESTED',
                                'REFUNDED'
                            )                   NOT NULL DEFAULT 'PENDING',
    `payment_method`        ENUM('gateway','manual') NOT NULL,
    `payment_timeout_at`    TIMESTAMP           NOT NULL,
    `payment_proof`         VARCHAR(500)        NULL DEFAULT NULL,
    `refund_bank_name`      VARCHAR(100)        NULL DEFAULT NULL,
    `refund_account_name`   VARCHAR(255)        NULL DEFAULT NULL,
    `refund_account_number` VARCHAR(50)         NULL DEFAULT NULL,
    `created_at`            TIMESTAMP           NULL DEFAULT NULL,
    `updated_at`            TIMESTAMP           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `orders_order_code_unique` (`order_code`),
    INDEX `orders_user_id_status_index` (`user_id`, `status`),
    INDEX `orders_vehicle_id_dates_index` (`vehicle_id`, `start_date`, `end_date`),
    INDEX `orders_payment_timeout_status_index` (`payment_timeout_at`, `status`),
    INDEX `orders_status_index` (`status`),
    INDEX `orders_vehicle_id_index` (`vehicle_id`),
    CONSTRAINT `fk_orders_user`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `fk_orders_vehicle`
        FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `orders_total_price_positive` CHECK (`total_price` > 0),
    CONSTRAINT `orders_date_range_valid` CHECK (`end_date` > `start_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: transactions (Immutable Audit Log)
-- ============================================================
CREATE TABLE IF NOT EXISTS `transactions` (
    `id`            BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `order_id`      BIGINT UNSIGNED     NOT NULL,
    `amount`        DECIMAL(12,2)       NOT NULL,
    `type`          ENUM('PAYMENT','REFUND','PARTIAL_REFUND') NOT NULL,
    `status`        ENUM('SUCCESS','FAILED','PENDING')        NOT NULL,
    `method`        ENUM('gateway','manual')                  NOT NULL,
    `gateway_ref`   VARCHAR(255)        NULL DEFAULT NULL,
    `actor`         ENUM('CUSTOMER','ADMIN','SYSTEM','GATEWAY') NOT NULL,
    `notes`         TEXT                NULL DEFAULT NULL,
    `created_at`    TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `transactions_order_id_index` (`order_id`),
    INDEX `transactions_type_status_index` (`type`, `status`),
    INDEX `transactions_actor_index` (`actor`),
    INDEX `transactions_created_at_index` (`created_at`),
    CONSTRAINT `fk_transactions_order`
        FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE
    -- No updated_at: immutable audit log (INSERT only)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: ratings
-- One rating per order (UNIQUE on order_id)
-- ============================================================
CREATE TABLE IF NOT EXISTS `ratings` (
    `id`            BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `order_id`      BIGINT UNSIGNED     NOT NULL,
    `user_id`       BIGINT UNSIGNED     NOT NULL,
    `vehicle_id`    BIGINT UNSIGNED     NOT NULL,
    `score`         TINYINT UNSIGNED    NOT NULL,
    `comment`       TEXT                NULL DEFAULT NULL,
    `created_at`    TIMESTAMP           NULL DEFAULT NULL,
    `updated_at`    TIMESTAMP           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `ratings_order_id_unique` (`order_id`),
    INDEX `ratings_vehicle_id_index` (`vehicle_id`),
    INDEX `ratings_user_id_index` (`user_id`),
    INDEX `ratings_score_index` (`score`),
    CONSTRAINT `fk_ratings_order`
        FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `fk_ratings_user`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `fk_ratings_vehicle`
        FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `ratings_score_range` CHECK (`score` >= 1 AND `score` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: notifications
-- ============================================================
CREATE TABLE IF NOT EXISTS `notifications` (
    `id`            CHAR(36)            NOT NULL,
    `type`          VARCHAR(255)        NOT NULL,
    `notifiable_type` VARCHAR(255)      NOT NULL,
    `notifiable_id` BIGINT UNSIGNED     NOT NULL,
    `data`          JSON                NOT NULL,
    `read_at`       TIMESTAMP           NULL DEFAULT NULL,
    `created_at`    TIMESTAMP           NULL DEFAULT NULL,
    `updated_at`    TIMESTAMP           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    INDEX `notifications_notifiable_index` (`notifiable_type`, `notifiable_id`),
    INDEX `notifications_read_at_index` (`read_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: sessions (Laravel session storage)
-- ============================================================
CREATE TABLE IF NOT EXISTS `sessions` (
    `id`            VARCHAR(255)        NOT NULL,
    `user_id`       BIGINT UNSIGNED     NULL DEFAULT NULL,
    `ip_address`    VARCHAR(45)         NULL DEFAULT NULL,
    `user_agent`    TEXT                NULL DEFAULT NULL,
    `payload`       LONGTEXT            NOT NULL,
    `last_activity` INT                 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `sessions_user_id_index` (`user_id`),
    INDEX `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: cache
-- ============================================================
CREATE TABLE IF NOT EXISTS `cache` (
    `key`           VARCHAR(255)    NOT NULL,
    `value`         MEDIUMTEXT      NOT NULL,
    `expiration`    INT             NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: cache_locks
-- ============================================================
CREATE TABLE IF NOT EXISTS `cache_locks` (
    `key`           VARCHAR(255)    NOT NULL,
    `owner`         VARCHAR(255)    NOT NULL,
    `expiration`    INT             NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: jobs (Laravel Queue)
-- ============================================================
CREATE TABLE IF NOT EXISTS `jobs` (
    `id`            BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `queue`         VARCHAR(255)        NOT NULL,
    `payload`       LONGTEXT            NOT NULL,
    `attempts`      TINYINT UNSIGNED    NOT NULL,
    `reserved_at`   INT UNSIGNED        NULL DEFAULT NULL,
    `available_at`  INT UNSIGNED        NOT NULL,
    `created_at`    INT UNSIGNED        NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: failed_jobs
-- ============================================================
CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id`            BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `uuid`          VARCHAR(255)        NOT NULL,
    `connection`    TEXT                NOT NULL,
    `queue`         TEXT                NOT NULL,
    `payload`       LONGTEXT            NOT NULL,
    `exception`     LONGTEXT            NOT NULL,
    `failed_at`     TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
