<?php

class MLCSocialActionPanelBase extends MJaxPanel{
    public $arrSAData = null;
    public $objEntity = null;
    public $objSocialAction = null;
    public $objParentAction = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $strFileLoc = __VIEW_ACTIVE_APP_DIR__ . '/www/social/' . get_class($this) . '.tpl.php';
        if(file_exists($strFileLoc)){
            $this->strTemplate = $strFileLoc;
        }else{
            $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/panels/' . get_class($this) . '.tpl.php';
        }

    }

    public function RenderSocialActionData($strData){
        if (is_null($this->arrSAData)) {
            $this->arrSAData = _jd($this->objSocialAction->Data, true);
        }
        if(
            (!is_null($this->arrSAData)) &&
            (array_key_exists($strData,$this->arrSAData))
        ){
            return $this->arrSAData[$strData];
        }
        return null;
    }
    public function RenderTimePast(){
        $objNow = new DateTime('now');
        $objDateDiff = $objNow->diff(new DateTime($this->objSocialAction->CreDate));
        if($objDateDiff->d > 0){
            $strReturn =  $objDateDiff->Format('%d days');
        }elseif($objDateDiff->h > 0){
            $strReturn = $objDateDiff->Format('%h hours');
        }elseif($objDateDiff->i > 0){
            $strReturn = $objDateDiff->Format('%i minutes');
        }else{
            $strReturn = $objDateDiff->Format('%s seconds');
        }
        echo $strReturn;
    }

    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "Entity": return $this->objEntity;
            case "SocialAction": return $this->objSocialAction;
            case "ParentAction": return $this->objParentAction;
            default:
                return parent::__get($strName);

        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue) {
        switch ($strName) {
            case "Entity": return $this->objEntity = $mixValue;
            case "SocialAction": return $this->objSocialAction = $mixValue;
            case "ParentAction": return $this->objParentAction = $mixValue;

            default:
                return parent::__set($strName, $mixValue);

        }
    }
}