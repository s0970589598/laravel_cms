<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = <<<EOL
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('23', '用户登入頁面', '0', '0', '1', 'admin::login.show', '/admin/login', '基礎功能', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('24', '用户登入', '0', '0', '1', 'admin::login', '/admin/login', '基礎功能', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-08 10:35:50');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('26', '首頁', '0', '1', '1', 'admin::index', '/admin/index', '基礎功能', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-08 10:50:16');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('27', '管理員列表', '40', '1', '1', 'admin::adminUser.index', '/admin/admin_users', '管理員管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('28', '管理員列表數據', '40', '0', '2', 'admin::adminUser.list', '/admin/admin_users/list', '管理員管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('29', '新增管理員', '40', '1', '2', 'admin::adminUser.create', '/admin/admin_users/create', '管理員管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('30', '保存管理員', '40', '0', '1', 'admin::adminUser.save', '/admin/admin_users', '管理員管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('31', '編輯管理員', '40', '0', '2', 'admin::adminUser.edit', '', '管理員管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('32', '更新管理員', '40', '0', '2', 'admin::adminUser.update', '', '管理員管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('33', '選單列表', '40', '1', '1', 'admin::menu.index', '/admin/menus', '選單管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('34', '選單列表數據', '40', '0', '1', 'admin::menu.list', '/admin/menus/list', '選單管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('35', '新增選單', '40', '1', '2', 'admin::menu.create', '/admin/menus/create', '選單管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('36', '保存選單', '40', '0', '1', 'admin::menu.save', '/admin/menus', '選單管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('37', '編輯選單', '40', '0', '2', 'admin::menu.edit', '', '選單管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('38', '更新選單', '40', '0', '1', 'admin::menu.update', '', '選單管理', 'admin', '', '0', '2019-02-28 12:50:35', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('40', '系统管理', '0', '1', '1', 'admin::config.index', '/admin/configs', '', 'admin', '', '1', NULL, '2019-03-21 17:07:49');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('41', '自動更新選單', '40', '0', '1', 'admin::menu.discovery', '/admin/menus/discovery', '選單管理', 'admin', '', '0', '2019-02-28 15:36:34', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('43', '角色列表', '40', '1', '1', 'admin::role.index', '/admin/roles', '角色管理', 'admin', '', '0', '2019-03-01 14:17:26', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('44', '角色列表數據接口', '40', '0', '1', 'admin::role.list', '/admin/roles/list', '角色管理', 'admin', '', '0', '2019-03-01 14:17:26', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('45', '新增角色', '40', '1', '2', 'admin::role.create', '/admin/roles/create', '角色管理', 'admin', '', '0', '2019-03-01 14:17:26', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('46', '保存角色', '40', '0', '1', 'admin::role.save', '/admin/roles', '角色管理', 'admin', '', '0', '2019-03-01 14:17:26', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('47', '編輯角色', '40', '0', '1', 'admin::role.edit', '', '角色管理', 'admin', '', '0', '2019-03-01 14:17:26', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('48', '更新角色', '40', '0', '1', 'admin::role.update', '', '角色管理', 'admin', '', '0', '2019-03-01 14:17:26', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('49', '分配角色', '40', '0', '1', 'admin::adminUser.role.edit', '', '管理員管理', 'admin', '', '0', '2019-03-01 16:54:43', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('50', '更新用户角色', '40', '0', '1', 'admin::adminUser.role.update', '', '管理員管理', 'admin', '', '0', '2019-03-01 16:54:43', '2019-03-21 16:37:32');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('51', '分配權限', '40', '0', '1', 'admin::role.permission.edit', '', '角色管理', 'admin', '', '0', '2019-03-02 12:04:28', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('52', '更新權限', '40', '0', '1', 'admin::role.permission.update', '', '角色管理', 'admin', '', '0', '2019-03-02 12:04:28', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('53', '配置列表數據接口', '40', '0', '1', 'admin::config.list', '/admin/configs/list', '配置管理', 'admin', '', '0', '2019-03-04 12:09:17', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('54', '新增配置', '40', '1', '7', 'admin::config.create', '/admin/configs/create', '配置管理', 'admin', '', '0', '2019-03-04 12:09:17', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('55', '保存配置', '40', '0', '1', 'admin::config.save', '/admin/configs', '配置管理', 'admin', '', '0', '2019-03-04 12:09:17', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('56', '編輯配置', '40', '0', '1', 'admin::config.edit', '', '配置管理', 'admin', '', '0', '2019-03-04 12:09:17', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('57', '更新配置', '40', '0', '1', 'admin::config.update', '', '配置管理', 'admin', '', '0', '2019-03-04 12:09:17', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('58', 'Log列表', '40', '1', '10', 'admin::log.index', '/admin/logs', 'Log管理', 'admin', '', '0', '2019-03-06 09:53:46', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('59', 'Log列表數據接口', '40', '0', '1', 'admin::log.list', '/admin/logs/list', 'Log管理', 'admin', '', '0', '2019-03-06 09:53:46', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('61', '批量操作', '40', '0', '1', 'admin::menu.batch', '/admin/menus/batch', '選單管理', 'admin', '', '0', '2019-03-06 16:03:14', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('62', 'Google', '0', '1', '4', 'google', 'https://www.google.com', '', 'admin', '', '0', '2019-03-06 17:01:30', '2019-03-16 11:34:30');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('64', '刪除選單', '40', '0', '1', 'admin::menu.delete', '', '選單管理', 'admin', '', '0', '2019-03-07 09:45:17', '2019-03-07 16:52:51');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('79', '分類列表', '26', '1', '20', 'admin::category.index', '/admin/categories', '分類管理', 'admin', '', '0', '2019-03-08 08:57:30', '2019-03-15 10:30:40');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('80', '分類列表數據接口', '26', '0', '1', 'admin::category.list', '/admin/categories/list', '分類管理', 'admin', '', '0', '2019-03-08 08:57:30', '2019-03-08 09:07:41');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('81', '新增分類', '26', '1', '21', 'admin::category.create', '/admin/categories/create', '分類管理', 'admin', '', '0', '2019-03-08 08:57:30', '2019-03-15 10:30:28');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('82', '保存分類', '26', '0', '1', 'admin::category.save', '/admin/categories', '分類管理', 'admin', '', '0', '2019-03-08 08:57:30', '2019-03-08 09:07:11');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('83', '編輯分類', '26', '0', '1', 'admin::category.edit', '', '分類管理', 'admin', '', '0', '2019-03-08 08:57:30', '2019-03-08 09:07:11');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('84', '更新分類', '26', '0', '1', 'admin::category.update', '', '分類管理', 'admin', '', '0', '2019-03-08 08:57:30', '2019-03-08 09:07:11');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('85', '退出登入', '0', '0', '1', 'admin::logout', '/admin/logout', '基礎功能', 'admin', '', '0', '2019-03-08 10:50:34', '2019-03-08 10:50:53');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('86', '模型列表', '26', '1', '0', 'admin::entity.index', '/admin/entities', '模型管理', 'admin', '', '0', '2019-03-08 11:57:54', '2019-03-08 14:24:23');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('87', '模型列表數據接口', '26', '0', '1', 'admin::entity.list', '/admin/entities/list', '模型管理', 'admin', '', '0', '2019-03-08 11:57:54', '2019-03-08 11:58:50');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('88', '新增模型', '26', '1', '1', 'admin::entity.create', '/admin/entities/create', '模型管理', 'admin', '', '0', '2019-03-08 11:57:54', '2019-03-08 11:58:31');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('89', '保存模型', '26', '0', '1', 'admin::entity.save', '/admin/entities', '模型管理', 'admin', '', '0', '2019-03-08 11:57:54', '2019-03-08 11:58:31');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('90', '編輯模型', '26', '0', '1', 'admin::entity.edit', '', '模型管理', 'admin', '', '0', '2019-03-08 11:57:54', '2019-03-08 11:58:31');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('91', '更新模型', '26', '0', '1', 'admin::entity.update', '', '模型管理', 'admin', '', '0', '2019-03-08 11:57:54', '2019-03-08 11:58:31');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('92', '刪除模型', '26', '0', '1', 'admin::entity.delete', '', '模型管理', 'admin', '', '0', '2019-03-08 11:57:54', '2019-03-08 11:58:31');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('93', '模型字段列表', '26', '1', '10', 'admin::entityField.index', '/admin/entityFields', '模型字段管理', 'admin', '', '0', '2019-03-08 14:10:31', '2019-03-12 13:37:19');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('94', '模型字段列表數據接口', '26', '0', '1', 'admin::entityField.list', '/admin/entityFields/list', '模型字段管理', 'admin', '', '0', '2019-03-08 14:10:31', '2019-03-08 14:11:20');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('95', '新增模型字段', '26', '1', '11', 'admin::entityField.create', '/admin/entityFields/create', '模型字段管理', 'admin', '', '0', '2019-03-08 14:10:31', '2019-03-12 13:37:39');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('96', '保存模型字段', '26', '0', '1', 'admin::entityField.save', '/admin/entityFields', '模型字段管理', 'admin', '', '0', '2019-03-08 14:10:31', '2019-03-08 14:11:08');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('97', '編輯模型字段', '26', '0', '1', 'admin::entityField.edit', '', '模型字段管理', 'admin', '', '0', '2019-03-08 14:10:31', '2019-03-08 14:11:08');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('98', '更新模型字段', '26', '0', '1', 'admin::entityField.update', '', '模型字段管理', 'admin', '', '0', '2019-03-08 14:10:31', '2019-03-08 14:11:08');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('99', '刪除模型字段', '26', '0', '1', 'admin::entityField.delete', '', '模型字段管理', 'admin', '', '0', '2019-03-08 14:10:31', '2019-03-08 14:11:08');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('103', '保存内容', '0', '0', '1', 'admin::content.save', '', '内容管理', 'admin', '', '0', '2019-03-15 10:33:49', '2019-03-15 10:33:49');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('104', '編輯内容', '107', '0', '1', 'admin::content.edit', '', '内容管理', 'admin', '', '0', '2019-03-15 10:33:49', '2019-03-15 10:33:49');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('105', '更新内容', '0', '0', '1', 'admin::content.update', '', '内容管理', 'admin', '', '0', '2019-03-15 10:33:49', '2019-03-15 10:33:49');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('106', '刪除内容', '0', '0', '1', 'admin::content.delete', '', '内容管理', 'admin', '', '0', '2019-03-15 10:33:49', '2019-03-15 10:33:49');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('107', '内容管理', '0', '1', '1', 'admin::aggregation', '/admin/aggregation', '内容管理', 'admin', '', '0', '2019-03-15 10:36:29', '2019-03-15 10:36:29');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('108', '内容列表', '107', '0', '1', 'admin::content.index', '', '内容管理', 'admin', '', '0', '2019-03-16 11:34:06', '2019-03-16 11:34:06');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('109', '内容列表數據接口', '0', '0', '1', 'admin::content.list', '', '内容管理', 'admin', '', '0', '2019-03-16 11:34:06', '2019-03-16 11:34:06');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('110', '新增内容', '107', '0', '1', 'admin::content.create', '', '内容管理', 'admin', '', '0', '2019-03-16 11:34:06', '2019-03-16 11:34:06');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('111', '圖片上傳', '0', '0', '1', 'admin::neditor.serve', '', '基礎功能', 'admin', '', '0', '2019-03-21 16:37:32', '2019-03-21 16:40:36');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('118', '刪除模板', '26', '0', '77', 'admin::template.delete', '', '模板管理', 'admin', '', '0', '2019-03-27 14:00:59', '2019-03-27 14:08:20');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('117', '更新模板', '26', '0', '77', 'admin::template.update', '', '模板管理', 'admin', '', '0', '2019-03-27 14:00:59', '2019-03-27 14:08:20');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('116', '編輯模板', '26', '0', '77', 'admin::template.edit', '', '模板管理', 'admin', '', '0', '2019-03-27 14:00:59', '2019-03-27 14:08:20');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('115', '保存模板', '26', '0', '77', 'admin::template.save', '/admin/templates', '模板管理', 'admin', '', '0', '2019-03-27 14:00:59', '2019-03-27 14:08:20');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('114', '新增模板', '26', '1', '55', 'admin::template.create', '/admin/templates/create', '模板管理', 'admin', '', '0', '2019-03-27 14:00:59', '2019-03-27 14:09:25');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('113', '模板列表數據接口', '26', '0', '77', 'admin::template.list', '/admin/templates/list', '模板管理', 'admin', '', '0', '2019-03-27 14:00:59', '2019-03-27 14:08:20');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('112', '模板列表', '26', '1', '55', 'admin::template.index', '/admin/templates', '模板管理', 'admin', '', '0', '2019-03-27 14:00:59', '2019-03-27 14:09:25');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('125', '刪除會員', '26', '0', '100', 'admin::user.delete', '', '會員管理', 'admin', '', '0', '2019-04-04 09:04:35', '2019-04-04 09:06:41');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('124', '更新會員', '26', '0', '100', 'admin::user.update', '', '會員管理', 'admin', '', '0', '2019-04-04 09:04:35', '2019-04-04 09:06:41');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('123', '編輯會員', '26', '0', '100', 'admin::user.edit', '', '會員管理', 'admin', '', '0', '2019-04-04 09:04:35', '2019-04-04 09:06:41');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('122', '保存會員', '26', '0', '100', 'admin::user.save', '/admin/users', '會員管理', 'admin', '', '0', '2019-04-04 09:04:35', '2019-04-04 09:06:41');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('121', '新增會員', '26', '1', '100', 'admin::user.create', '/admin/users/create', '會員管理', 'admin', '', '0', '2019-04-04 09:04:35', '2019-04-04 09:06:41');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('120', '會員列表數據接口', '26', '0', '100', 'admin::user.list', '/admin/users/list', '會員管理', 'admin', '', '0', '2019-04-04 09:04:35', '2019-04-08 14:07:28');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `is_lock_name`, `created_at`, `updated_at`) VALUES ('119', '會員列表', '26', '1', '100', 'admin::user.index', '/admin/users', '會員管理', 'admin', '', '0', '2019-04-04 09:04:35', '2019-04-04 09:06:41');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('140', '刪除標簽', '26', '0', '0', '30', 'admin::tag.delete', '', '標簽管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 10:54:23');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('139', '更新標簽', '26', '0', '0', '30', 'admin::tag.update', '', '標簽管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 10:54:23');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('138', '編輯標簽', '26', '0', '0', '30', 'admin::tag.edit', '', '標簽管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 10:54:23');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('137', '保存標簽', '26', '0', '0', '30', 'admin::tag.save', '/admin/tags', '標簽管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 10:54:23');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('136', '新增標簽', '26', '1', '0', '30', 'admin::tag.create', '/admin/tags/create', '標簽管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 10:54:23');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('135', '標簽列表數據接口', '26', '0', '0', '30', 'admin::tag.list', '/admin/tags/list', '標簽管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 10:54:23');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('134', '標簽列表', '26', '1', '0', '29', 'admin::tag.index', '/admin/tags', '標簽管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 10:54:35');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('133', '刪除評論', '26', '0', '0', '90', 'admin::comment.delete', '', '評論管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 11:03:11');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('132', '更新評論', '26', '0', '0', '90', 'admin::comment.update', '', '評論管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 11:03:11');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('131', '編輯評論', '26', '0', '0', '90', 'admin::comment.edit', '', '評論管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 11:03:11');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('130', '評論列表數據接口', '26', '0', '0', '90', 'admin::comment.list', '/admin/comments/list', '評論管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 11:03:11');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('129', '評論列表', '26', '1', '0', '90', 'admin::comment.index', '/admin/comments', '評論管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 11:03:11');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('128', '内容批量操作', '0', '0', '0', '0', 'admin::content.batch', '', '内容管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 09:49:15');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('127', '字段快捷更新接口', '0', '0', '0', '0', 'admin::entityField.listUpdate', '', '模型字段管理', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 10:43:10');
INSERT INTO `menus` (`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`) VALUES ('126', 'ueditor編輯服務', '0', '0', '0', '0', 'admin::ueditor.serve', '/admin/ueditor/serve', 'ueditor', 'admin', '', '2019-10-23 09:49:15', '2019-10-23 09:51:28');
INSERT INTO `menus`(`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`, `route_params`) VALUES (149, '刪除敏感詞', 40, 0, 0, 7, 'admin::SensitiveWord.delete', '', '敏感詞管理', 'admin', '', '2020-07-02 14:46:42', '2020-07-02 14:48:02', '');
INSERT INTO `menus`(`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`, `route_params`) VALUES (148, '更新敏感詞', 40, 0, 0, 7, 'admin::SensitiveWord.update', '', '敏感詞管理', 'admin', '', '2020-07-02 14:46:42', '2020-07-02 14:48:02', '');
INSERT INTO `menus`(`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`, `route_params`) VALUES (147, '編輯敏感詞', 40, 0, 0, 7, 'admin::SensitiveWord.edit', '', '敏感詞管理', 'admin', '', '2020-07-02 14:46:42', '2020-07-02 14:48:02', '');
INSERT INTO `menus`(`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`, `route_params`) VALUES (146, '保存敏感詞', 40, 0, 0, 7, 'admin::SensitiveWord.save', '/admin/SensitiveWords', '敏感詞管理', 'admin', '', '2020-07-02 14:46:42', '2020-07-02 14:48:02', '');
INSERT INTO `menus`(`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`, `route_params`) VALUES (145, '新增敏感詞', 40, 1, 0, 7, 'admin::SensitiveWord.create', '/admin/SensitiveWords/create', '敏感詞管理', 'admin', '', '2020-07-02 14:46:42', '2020-07-02 14:48:02', '');
INSERT INTO `menus`(`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`, `route_params`) VALUES (144, '敏感詞列表數據接口', 40, 0, 0, 7, 'admin::SensitiveWord.list', '/admin/SensitiveWords/list', '', 'admin', '', '2020-07-02 14:46:42', '2020-07-02 14:48:02', '');
INSERT INTO `menus`(`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`, `route_params`) VALUES (143, '敏感詞列表', 40, 1, 0, 7, 'admin::SensitiveWord.index', '/admin/SensitiveWords', '敏感詞管理', 'admin', '', '2020-07-02 14:46:42', '2020-07-02 14:48:02', '');
INSERT INTO `menus`(`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`, `route_params`) VALUES (142, '添加默認選單', 0, 0, 0, 0, 'admin::entity.menu', '', '模型管理', 'admin', '', '2020-07-02 14:46:42', '2020-07-02 14:46:42', '');
INSERT INTO `menus`(`id`, `name`, `pid`, `status`, `is_lock_name`, `order`, `route`, `url`, `group`, `guard_name`, `remark`, `created_at`, `updated_at`, `route_params`) VALUES (141, '覆製模型', 0, 0, 0, 0, 'admin::entity.copy', '', '模型管理', 'admin', '', '2020-07-02 14:46:42', '2020-07-02 14:46:42', '');
EOL;
        DB::unprepared($sql);
    }
}
