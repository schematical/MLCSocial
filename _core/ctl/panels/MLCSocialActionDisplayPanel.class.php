<?php

class MLCSocialActionDisplayPanel extends MLCSocialActionPanelBase{
    public $lnkLike = null;
    public $lnkUsername = null;

    public function __construct($objParentControl, $strControlId = null, $objSocialAction)
    {
        parent::__construct($objParentControl, $strControlId);
        $this->SocialAction = $objSocialAction;
        $this->lnkLike = new MLCSocialLikeButton($this, null, $objSocialAction);
        $this->lnkLike->Text = 'Submit';
        /*switch($this->SocialAction->Type){
            case(MLCSocialActionType::LIKE):
                $strTplFile = get_class($this) . '_like'
            break;
        }*/
        $strTplFile = get_class($this) . '_' .strtolower($this->SocialAction->Type);

        $strFileLoc = __VIEW_ACTIVE_APP_DIR__ . '/www/social/' . $strTplFile . '.tpl.php';
        if(file_exists($strFileLoc)){
            $this->strTemplate = $strFileLoc;
        }else{
            $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/panels/' . $strTplFile . '.tpl.php';
        }
        //$this->lnkLike->AddCssClass('btn');
        $objUser = AuthUser::LoadById($this->objSocialAction->IdUser);
        $strNamespace = MLCNamespaceDriver::GetNamespaceByEntity($objUser);
        $this->lnkUsername = new MJaxLinkButton($this);
        $this->lnkUsername->Text = $objUser->Username;
        $this->lnkUsername->Href = '//'.$_SERVER['SERVER_NAME'] . '/'. $strNamespace;


    }


}