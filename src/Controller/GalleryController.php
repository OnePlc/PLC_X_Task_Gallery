<?php
/**
 * GalleryController.php - Main Controller
 *
 * Main Controller for Gallery Gallery Plugin
 *
 * @category Controller
 * @package Task\Gallery
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Task\Gallery\Controller;

use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use OnePlace\Task\Gallery\Model\GalleryTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class GalleryController extends CoreEntityController {
    /**
     * Gallery Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;

    /**
     * GalleryController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param GalleryTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,GalleryTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'taskgallery-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    # Custom Code here:
    public function attachGallery($oTask) {

        $aFields = [];
        $aUserFields = CoreEntityController::$oSession->oUser->getMyFormFields();
        if(array_key_exists('gallery-single',$aUserFields)) {
            $aFieldsTmp = $aUserFields['gallery-single'];
            if(count($aFieldsTmp) > 0) {
                # add all contact-base fields
                foreach($aFieldsTmp as $oField) {
                    if($oField->tab == 'gallery-base') {
                        $aFields[] = $oField;
                    }
                }
            }
        }
        $aFieldsByTab = ['task_gallery'=>$aFields];
        //var_dump($aFieldsByTab);
        # Pass Data to View - which will pass it to our partial
        return [
            # must be named aPartialExtraData
            'aPartialExtraData' => [
                # must be name of your partial
                'job_contact'=> [
                    'aFields'=>$aFields,
                    'aFormFields'=>$aFieldsByTab,
                ]
            ]
        ];
    }
}
