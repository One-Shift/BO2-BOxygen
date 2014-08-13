INSERT INTO `prefix_articles` (`id`, `title_1`, `content_1`, `title_2`, `content_2`, `title_3`, `content_3`, `title_4`, `content_4`, `title_5`, `content_5`, `title_6`, `content_6`, `code`, `user_id`, `category_id`, `date`, `date_update`, `published`, `onhome`, `priority`) VALUES
(1, '1st Article', '<br>', '', '<br>', '', '<br>', '', '<br>', '', '<br>', '', '<br>', '', 3, 1, '2014-03-15 01:48:54', '', 1, 0, NULL);

INSERT INTO `prefix_categories` (`id`, `name_1`, `description_1`, `name_2`, `description_2`, `name_3`, `description_3`, `name_4`, `description_4`, `name_5`, `description_5`, `name_6`, `description_6`, `category_type`, `date`, `date_update`, `user_id`, `code`, `published`) VALUES
(1, '1st Article Category', '<br>', '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, 'articles', '0000-00-00', '0000-00-00 00:00:00', 0, '', 1),
(2, '1st Product Category', '<br>', '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, 'products', '0000-00-00', '0000-00-00 00:00:00', 0, '', 1);

INSERT INTO `prefix_files_type` (`type`, `extension`, `upload_format`) VALUES
('application/mac-compactpro', 'cpt', 'document'),
('application/msword', 'doc', 'document'),
('application/octet-stream', 'unkwon', 'document'),
('application/pdf', 'pdf', 'document'),
('application/vnd.corel-draw', 'cdr', 'document'),
('application/vnd.ms-excel', 'xls', 'document'),
('application/vnd.ms-powerpoint', 'ppt', 'document'),
('application/vnd.oasis.opendocument.spreadsheet', 'ods', 'document'),
('application/vnd.openxmlformats-officedocument.presentationml.slideshow', 'pptx', 'document'),
('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xlsx', 'document'),
('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'docx', 'document'),
('application/x-zip-compressed', 'zip', 'document'),
('application/zip', 'zip', 'document'),
('image/bmp', 'bmp', 'image'),
('image/gif', 'gif', 'image'),
('image/jpeg', 'jpg', 'image'),
('image/png', 'png', 'image'),
('image/svg+xml', 'svg', 'image'),
('image/tiff', 'tiff', 'document'),
('image/vnd.adobe.photoshop', 'psd', 'document');


INSERT INTO `prefix_products` (`id`, `reference`, `title_1`, `content_1`, `title_2`, `content_2`, `title_3`, `content_3`, `title_4`, `content_4`, `title_5`, `content_5`, `title_6`, `content_6`, `code`, `service`, `price`, `vat`, `discount`, `user_id`, `category_id`, `date`, `date_update`, `published`, `onhome`, `priority`) VALUES
(5, '', 'reference', 'produto de teste', 'alguma descrição<br>', '', '<br>', '', '<br>', '', '<br>', '', '<br>', '', '<br>', 0, 1, 23, 0, 3, 1, '2012-01-01 00:00:00', '2012-01-01 00:00:00', 1, 0, NULL),
(6, '', 'nome', 'aqui texto<br>', 'nome', '<br>', 'nome', '<br>', 'nome', '<br>', 'nome', '<br>', 'nome', '<br>', '', 0, 1.23, 23.25, 0, 3, 1, '2012-01-01 00:00:00', '2012-01-01 00:00:00', 0, 0, NULL);


INSERT INTO `prefix_users` (`id`, `name`, `password`, `rank`, `email`, `code`, `date`, `date_update`) VALUES
(1, 'system', '9ccc4065e071a93e89b4327bb48b2aefe4f51a3e', 'owner', 'suporte@nexus-pt.eu', NULL, '2012-01-01 00:00:00', '2012-01-01 00:00:00'),
(3, 'demo', '9ccc4065e071a93e89b4327bb48b2aefe4f51a3e', 'manager', 'demo@nexus-pt.eu', NULL, '2012-01-01 00:00:00', '2012-01-01 00:00:00');
