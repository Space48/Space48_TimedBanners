<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS `{$this->getTable('space48timer/banners')}`;
CREATE TABLE IF NOT EXISTS `{$this->getTable('space48timer/banners')}` (
  `banner_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `start_date` datetime,
  `end_date` datetime,
  `background_image` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY  (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->endSetup();
