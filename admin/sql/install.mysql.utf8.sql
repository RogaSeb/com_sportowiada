--
-- Tabela `#__rt0n5_sportowiada_disciplines`
--

CREATE TABLE IF NOT EXISTS `#__sportowiada_disciplines` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `sportsart` TINYINT NOT NULL DEFAULT '0',
  `ordering` INT NOT NULL DEFAULT 0,
  `checked_out` INT UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` DATETIME DEFAULT NULL,
  `created_by` INT UNSIGNED NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` INT UNSIGNED DEFAULT NULL,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `access` INT UNSIGNED NOT NULL DEFAULT 1,
  `params` text,
  PRIMARY KEY (`id`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;