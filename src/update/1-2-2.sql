/**
 * Users
 */
  ALTER TABLE `users`
CHANGE COLUMN `language` `language` VARCHAR(6) NOT NULL DEFAULT 'en_GB';
