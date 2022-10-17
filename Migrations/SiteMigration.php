<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Migration\Migrations;

use Piwik\Common;
use Piwik\Db;
use Piwik\Plugins\Migration\TargetDb;

class SiteMigration extends BaseMigration
{
    private $targetIdSite;

    public function validateStructure(TargetDb $targetDb)
    {
        return $this->checkTablesHaveSameStructure($targetDb, 'site');
    }

    public function migrate(Request $request, TargetDb $targetDb)
    {
        $row = Db::fetchRow('SELECT * FROM ' . Common::prefixTable('site') . ' WHERE idsite = ?', array($request->sourceIdSite));
        $targetDb->update('site', array('ts_created' => $row['ts_created']), array('idsite' => $request->targetIdSite));
    }
}
