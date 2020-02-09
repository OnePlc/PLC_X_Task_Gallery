<?php
/**
 * Gallery.php - Gallery Entity
 *
 * Entity Model for Gallery Gallery
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

use Application\Model\CoreEntityModel;

class Gallery extends CoreEntityModel {
    /**
     * Gallery constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @since 1.0.0
     */
    public function __construct($oDbAdapter) {
        parent::__construct($oDbAdapter);

        # Set Single Form Name
        $this->sSingleForm = 'taskgallery-single';

        # Attach Dynamic Fields to Entity Model
        $this->attachDynamicFields();
    }

    /**
     * Set Entity Data based on Data given
     *
     * @param array $aData
     * @since 1.0.0
     */
    public function exchangeArray(array $aData) {
        $this->id = !empty($aData['Gallery_ID']) ? $aData['Gallery_ID'] : 0;

        $this->updateDynamicFields($aData);
    }

    public function getLabel() {
        return $this->street;
    }
}