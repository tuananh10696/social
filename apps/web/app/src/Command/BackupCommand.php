<?php
namespace App\Command;

/**
 * crontab
 * 00 01 * * * /home/cms-v6/apps/web/app/bin/cake backup >/dev/null 2>&1
 * または
 * 00 01 * * * php74 /home/cms-v6/apps/web/app/bin/cake.php backup >/dev/null 2>&1
 *
 * /config/.dbaccess.cnf内にアクセス情報を書いておく
 * DBユーザーの権限はPROCESSが必要
 */

use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Controller\ComponentRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
class BackupCommand extends Command
{
    public function initialize() :void
    {
        parent::initialize();

    }
    protected function buildOptionParser(ConsoleOptionParser $parser) :ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        $parser->addArgument("date", [ // id をArgumentsに指定
            'help' => "DBの定期バックアップの現在日",
            'required' => false
        ]);
        // 複数指定
//        $parser
//            ->addArguments([
//                'id' => ['required' => true],
//                'basedir' => ['required' => true],
//            ]);
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->_backup();
    }

    /**
     * 発送メール
     * @return void
     */
    private function _backup()
    {
        $now = new \DateTime();
        $mysql_config_path = realpath(APP . '../config/.dbaccess.cnf');
        $mysqldump_cmd = "mysqldump --defaults-file={$mysql_config_path} %s | gzip> %s";
        $cn = ConnectionManager::get('default');
        $conf = $cn->config();

        $database = $conf["database"];
        $backup_dir = realpath(APP . '../tmp/mysqldump');
        $cmd_params = '--opt ' . $database .  ' --hex-blob';

        // mmdd単位でログを作成
        $backup_filename = sprintf('%s.sql.gz', $database . $now->format('md'));
        $path = $backup_dir . DS . $backup_filename;

        $cmd = sprintf($mysqldump_cmd
                ,$cmd_params
                ,$path);
        system($cmd);

        // BACKUP_DB_DAY
        $before_day_at = clone($now);
        $before_day_at->modify('-' . BACKUP_DB_DAY. ' day');

        // BACKUP_DB_DAY日前のデータ削除
        $del_filename = sprintf('%s.sql.gz',$database . $before_day_at->format('md'));
        $del_path = $backup_dir . DS .  $del_filename;
        @unlink($del_path);

        if (BACKUP_DB_MONTH_KEEP === 'on') {
            // 月に1回ファイルを残す
            if($now->format('d') == '00'){
                $yesterday_dt = clone($now);
                $yesterday_dt->modify('-1 day');

                $source = sprintf($backup_dir . DS .'%s.sql.gz', $database . $yesterday_dt->format('md'));
                $dest = sprintf($backup_dir . DS . '%s.sql.gz', $database . $yesterday_dt->format('Ym'));
                copy($source,$dest);
            }
        }

    }


}