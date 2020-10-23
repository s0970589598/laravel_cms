<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = <<<EOL
INSERT INTO `configs` (`id`, `name`, `key`, `value`, `type`, `group`, `remark`, `created_at`, `updated_at`) VALUES ('1', '副文本編輯器', 'RICH_TEXT_EDITOR', 'neditor', '1', '系统', '系统副文本編輯器類型。有效設置值：neditor、ueditor。', '2019-09-16 10:02:46', '2019-09-17 09:37:17');
INSERT INTO `configs` (`id`, `name`, `key`, `value`, `type`, `group`, `remark`, `created_at`, `updated_at`) VALUES ('2', '行内表單展示數', 'FORM_INLINE_NUM', '5', '0', '系统', '', '2019-09-16 10:19:01', '2019-09-16 10:19:01');
EOL;
        DB::unprepared($sql);
    }
}
