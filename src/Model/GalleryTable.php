<?php
/**
 * GalleryTable.php - Gallery Table
 *
 * Table Model for Gallery Gallery
 *
 * @category Model
 * @package Task\Gallery
 * @author Verein onePlace
 * @copyright (C) 2020 Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Task\Gallery\Model;

use Application\Controller\CoreController;
use Application\Model\CoreEntityTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\DbSelect;

class GalleryTable extends CoreEntityTable {

    /**
     * GalleryTable constructor.
     *
     * @param TableGateway $tableGateway
     * @since 1.0.0
     */
    public function __construct(TableGateway $tableGateway) {
        parent::__construct($tableGateway);

        # Set Single Form Name
        $this->sSingleForm = 'taskgallery-single';
    }

    /**
     * Get Gallery Entity
     *
     * @param int $id
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id) {
        # Use core function
        return $this->getSingleEntity($id,'Gallery_ID');
    }

    /**
     * Save Gallery Entity
     *
     * @param Gallery $oGallery
     * @return int Gallery ID
     * @since 1.0.0
     */
    public function saveSingle(Gallery $oGallery) {
        $aData = [];

        $aData = $this->attachDynamicFields($aData,$oGallery);

        $id = (int) $oGallery->id;

        if ($id === 0) {
            # Add Metadata
            $aData['created_by'] = CoreController::$oSession->oUser->getID();
            $aData['created_date'] = date('Y-m-d H:i:s',time());
            $aData['modified_by'] = CoreController::$oSession->oUser->getID();
            $aData['modified_date'] = date('Y-m-d H:i:s',time());

            # Insert Gallery
            $this->oTableGateway->insert($aData);

            # Return ID
            return $this->oTableGateway->lastInsertValue;
        }

        # Check if Gallery Entity already exists
        try {
            $this->getSingle($id);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException(sprintf(
                'Cannot update Gallery with identifier %d; does not exist',
                $id
            ));
        }

        # Update Metadata
        $aData['modified_by'] = CoreController::$oSession->oUser->getID();
        $aData['modified_date'] = date('Y-m-d H:i:s',time());

        # Update Gallery
        $this->oTableGateway->update($aData, ['Gallery_ID' => $id]);

        return $id;
    }

    /**
     * Generate new single Entity
     *
     * @return Gallery
     * @since 1.0.0
     */
    public function generateNew() {
        return new Gallery($this->oTableGateway->getAdapter());
    }
}