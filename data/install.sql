
--
-- Core Form - Task Gallery Tab Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'gallery', 'Images Upload', 'task_images', 'gallery-base', 'taskgallery-single', 'col-md-12', '', '', 0, 1, 0, '', '', '');

--
-- core Form Tabs
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES
('task-images', 'task-single', 'Images', 'upload files', 'fas fa-upload', '', 1, '', '');
