<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolCli;

class Uninstaller extends AbstractCommand
{
    public function run()
    {
        $tableNames = $this->metadata->getTableNames();

        $this->query("SET foreign_key_checks = 0;");
        foreach ($tableNames as $tableName) {
            $action = new \Zend\Db\Sql\Ddl\DropTable($tableName);
            $this->query($action);
        }
        $this->query("SET foreign_key_checks = 1;");
    }
}
