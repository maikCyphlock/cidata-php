-- =============================================================
-- Migration: 001_schema.sql
-- Project:   cidata-php
-- Created:   2026-04-25
-- Run:       mysql -u root maikol_cidata < migrations/001_schema.sql
--            or: docker exec -i <container> mysql -u root maikol_cidata < migrations/001_schema.sql
-- Idempotent: yes — uses CREATE TABLE IF NOT EXISTS, INSERT IGNORE
-- =============================================================

-- -------------------------------------------------------------
-- Table: admin_users
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS admin_users (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username      VARCHAR(50)  NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------
-- Table: plans
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS plans (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(100)  NOT NULL,
  type        ENUM('residencial','corporativo') NOT NULL DEFAULT 'residencial',
  subtitle    VARCHAR(100)  DEFAULT NULL,
  description TEXT          DEFAULT NULL,
  price       DECIMAL(10,2) NOT NULL,
  features    JSON          NOT NULL DEFAULT ('[]'),
  cta_text    VARCHAR(50)   DEFAULT 'Contratar ahora',
  is_popular  TINYINT(1)    NOT NULL DEFAULT 0,
  sort_order  INT           NOT NULL DEFAULT 0,
  active      TINYINT(1)    NOT NULL DEFAULT 1,
  created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------
-- Table: reviews
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS reviews (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  author      VARCHAR(100) NOT NULL,
  initials    VARCHAR(5)   NOT NULL,
  review_date VARCHAR(50)  DEFAULT NULL,
  content     TEXT         NOT NULL,
  rating      TINYINT UNSIGNED NOT NULL DEFAULT 5,
  sort_order  INT          NOT NULL DEFAULT 0,
  active      TINYINT(1)   NOT NULL DEFAULT 1,
  created_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT chk_rating CHECK (rating BETWEEN 1 AND 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------
-- Table: news_posts
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS news_posts (
  id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title        VARCHAR(255) NOT NULL,
  slug         VARCHAR(255) NOT NULL UNIQUE,
  excerpt      TEXT         DEFAULT NULL,
  image_url    VARCHAR(500) DEFAULT NULL,
  tag          VARCHAR(50)  DEFAULT NULL,
  published_at DATE         DEFAULT NULL,
  active       TINYINT(1)   NOT NULL DEFAULT 1,
  created_at   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------
-- Table: site_settings
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS site_settings (
  setting_key   VARCHAR(100) NOT NULL,
  setting_value TEXT         NOT NULL,
  updated_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================================
-- SEED DATA
-- =============================================================

-- -------------------------------------------------------------
-- Seed: admin_users
-- IMPORTANT: Change this password immediately after first login.
-- To generate a new hash: php -r "echo password_hash('YourNewPassword', PASSWORD_DEFAULT);"
-- Default credentials: username=admin / password=Admin1234!
-- -------------------------------------------------------------
INSERT IGNORE INTO admin_users (username, password_hash) VALUES
('admin', '$2y$12$Af4G/quE5bYgp5G7KxW7u.GledzGcUNJ/rXnkmxjl3Z5EWmuTEKkm');

-- -------------------------------------------------------------
-- Seed: plans — Residenciales
-- -------------------------------------------------------------
INSERT IGNORE INTO plans (id, name, type, subtitle, price, features, is_popular, sort_order) VALUES
(1, '500 Mbps', 'residencial', 'Básico',  25.00, '["Conexión ultra estable","Instalación prioritaria"]',            0, 1),
(2, '750 Mbps', 'residencial', 'Medio',   30.00, '["Streaming en varios equipos","Excelente balance velocidad/precio"]', 1, 2),
(3, '1 Gbps',  'residencial', 'Ultra',   35.00, '["Máxima velocidad residencial","Soporte prioritario"]',           0, 3);

-- Seed: plans — Corporativos
INSERT IGNORE INTO plans (id, name, type, subtitle, price, features, is_popular, sort_order) VALUES
(4,  '20 Mbps', 'corporativo', 'Corporativo', 100.00, '["CIR 1:1 Garantizado","Soporte 24/7"]',             0, 4),
(5,  '30 Mbps', 'corporativo', 'Corporativo', 150.00, '["IP Pública Fija","Enlace Dedicado"]',               0, 5),
(6,  '40 Mbps', 'corporativo', 'Corporativo', 200.00, '["Fibra Óptica Directa","Monitoreo Proactivo"]',      0, 6),
(7,  '50 Mbps', 'corporativo', 'Corporativo', 250.00, '["SLA Garantizado 99.9%","Soporte VIP Directo"]',     1, 7);

-- -------------------------------------------------------------
-- Seed: reviews
-- -------------------------------------------------------------
INSERT IGNORE INTO reviews (id, author, initials, review_date, content, rating, sort_order) VALUES
(1, 'Carlos Rivas',     'CR', 'Abril 10, 2023',  'Desde que cambié a CIDATA, mi conexión es estable y rápida. El soporte siempre responde a tiempo.', 5, 1),
(2, 'Joaquín Herrera',  'JH', 'Mayo 5, 2023',    'La instalación fue más sencilla de lo que esperaba. Muy profesionales.',                             4, 2),
(3, 'Alquímidez Méndez','AM', 'Mayo 5, 2023',    'Excelente relación precio/velocidad en los planes corporativos.',                                     4, 3),
(4, 'Marcela Soto',     'MS', 'Marzo 22, 2023',  '1Gbps real. Para trabajar desde casa es la mejor opción que he probado.',                             5, 4),
(5, 'Valentín Paredes', 'VP', 'Mayo 10, 2023',   'Soporte técnico real, te atienden personas y no bots.',                                               4, 5);

-- -------------------------------------------------------------
-- Seed: news_posts
-- -------------------------------------------------------------
INSERT IGNORE INTO news_posts (id, title, slug, excerpt, image_url, tag, published_at) VALUES
(1, 'Cómo elegir el plan de Internet ideal para tu hogar',
   'como-elegir-plan-internet-hogar',
   'Comparación práctica entre planes.',
   'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=800&auto=format&fit=crop',
   'Guía',
   '2023-04-01'),
(2, 'Fibra óptica vs Internet tradicional: lo que debes saber',
   'fibra-optica-vs-internet-tradicional',
   'Ventajas clave en estabilidad y latencia.',
   'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=800&auto=format&fit=crop',
   'Tecnología',
   '2023-04-15'),
(3, '5 trucos para mejorar la señal Wi-Fi en casa',
   '5-trucos-mejorar-señal-wifi',
   'Consejos sencillos sobre ubicación y configuración.',
   'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?q=80&w=800&auto=format&fit=crop',
   'Tips',
   '2023-05-01'),
(4, 'Cómo reportar tu pago en línea en pocos pasos',
   'como-reportar-pago-en-linea',
   'Guía rápida para usar nuestro portal de pagos.',
   'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?q=80&w=800&auto=format&fit=crop',
   'Soporte',
   '2023-05-10');

-- -------------------------------------------------------------
-- Seed: site_settings
-- -------------------------------------------------------------
INSERT INTO site_settings (setting_key, setting_value) VALUES
('hero_eyebrow',            'Internet por Fibra Óptica'),
('hero_headline',           'Internet sin límites'),
('hero_headline_highlight', 'hogar y tu negocio'),
('hero_sub',                'Planes de Internet por fibra óptica en Portuguesa y la Región Centro Occidental. Velocidad simétrica, instalación rápida y soporte real.'),
('promo_eyebrow',           'Oferta Limitada'),
('promo_title',             'Tu mundo, tu conexión, tu internet'),
('promo_title_highlight',   'RÁPIDO'),
('promo_text',              'No te conformes con menos. Vive la experiencia de navegación definitiva con Cidata Fibra Óptica. Velocidad simétrica, latencia mínima y el mejor respaldo técnico de la región.')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

-- =============================================================
-- ROLLBACK (run in reverse if needed):
-- DROP TABLE IF EXISTS site_settings;
-- DROP TABLE IF EXISTS news_posts;
-- DROP TABLE IF EXISTS reviews;
-- DROP TABLE IF EXISTS plans;
-- DROP TABLE IF EXISTS admin_users;
-- Then git revert the modified section PHP files to restore hardcoded state.
-- =============================================================
