CREATE INDEX parent_index USING BTREE ON `groups` (`id_parent`);

ALTER TABLE `groups` ADD `products_count` INT UNSIGNED NULL;
