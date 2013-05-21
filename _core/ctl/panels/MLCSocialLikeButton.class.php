<?php
class MLCSocialLikeButton extends MLCSocialActionPanelBase{
    public $strUnlikedTemplate = null;
    public $strLikedTemplate = null;
    public function __construct($objParentControl, $strControlId = null, $objEntity = null){
        parent::__construct($objParentControl, $strControlId);
        $this->AddAction($this, '_click');
        $this->objEntity = $objEntity;
        $strFileLoc = __VIEW_ACTIVE_APP_DIR__ . '/www/social/MLCSocialLikeButton_liked.tpl.php';
        if(file_exists($strFileLoc)){
            $this->strUnlikedTemplate = $strFileLoc;
        }else{
            $this->strUnlikedTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/panels/MLCSocialLikeButton_unliked.tpl.php';
        }
        $strFileLoc = __VIEW_ACTIVE_APP_DIR__ . '/www/social/MLCSocialLikeButton_unliked.tpl.php';
        if(file_exists($strFileLoc)){
            $this->strLikedTemplate = $strFileLoc;
        }else{
            $this->strLikedTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/panels/MLCSocialLikeButton_liked.tpl.php';
        }
    }

    public function _click(){
        if (is_null($this->objSocialAction)) {
            $this->objSocialAction = MLCSocialDriver::AddSocialAction(
                MLCSocialActionType::LIKE,
                MLCAuthDriver::User(),
                $this->objEntity
            );
        }else{
            $this->objSocialAction->DelDate = MLCDateTime::Now();
            $this->objSocialAction->Save();
            $this->objSocialAction = null;
        }
    }
    public function Render($blnPrint = true, $blnRenderAsAjax = false){
        //Render Actions first if applicable
        $strRendered = '';//parent::Render();

        if (!is_null($this->objSocialAction)) {
            if(is_null($this->strLikedTemplate)){
                throw new Exception("Liked Template file not set");
            }
            $this->strTemplate = $this->strLikedTemplate;
        }else{
            if(is_null($this->strUnlikedTemplate)){
                throw new Exception("Liked Template file not set");
            }
            $this->strTemplate = $this->strUnlikedTemplate;
        }
        if(!is_null($this->strTemplate)){
            if(!file_exists($this->strTemplate)){
                throw new Exception("Template file (" . $this->strTemplate .") does not exist");
            }

            global $_CONTROL;
            $objPrevControl = $_CONTROL;
            $_CONTROL = $this;
            $_FORM = $this->objForm;
            $strInnerHtml = $this->objForm->EvaluateTemplate($this->strTemplate);
            $_CONTROL = $objPrevControl;
        }

        $strRendered .= sprintf(
            "<a id='%s' name='%s' %s>%s</a>",
            $this->strControlId,
            $this->strControlId,
            $this->GetAttrString(),
            $strInnerHtml
        );
        if($blnPrint){
            echo($strRendered);
        }else{
            return $strRendered;
        }
    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "LikedTemplate": return $this->strLikedTemplate;
            case "UnlikedTemplate": return $this->strUnlikedTemplate;
            default:
                return parent::__get($strName);

        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue) {
        switch ($strName) {
            case "LikedTemplate": return $this->strLikedTemplate = $mixValue;
            case "UnlikedTemplate": return $this->strUnlikedTemplate = $mixValue;
            default:
                return parent::__set($strName, $mixValue);

        }
    }

}