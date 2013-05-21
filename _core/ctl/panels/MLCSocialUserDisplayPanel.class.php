<?php

class MLCSocialUserDisplayPanel extends MLCSocialActionPanelBase{

    public $lnkFollow = null;
    public function __construct($objParentControl, $strControlId = null, AuthUser $objEntity = null){
        parent::__construct($objParentControl, $strControlId);
        $this->objEntity = $objEntity;
        /*
        $this->lnkFollow = new MJaxLinkButton($this);
        $this->lnkFollow->Text = 'Follow';

        $this->lnkFollow->AddAction($this, 'lnkFollow_click');
        */
        $this->AddAction($this, '_click');
        $this->Style->Cursor = 'pointer';

    }
    public function _click(){
        $this->objForm->Redirect(
            MLCSocialDriver::ProfileUrl($this->objEntity)
        );
    }
    public function lnkFollow_click()
    {
        //Create a subscription

        //Create an action
        MLCSocialDriver::AddSocialAction(
            MLCSocialActionType::FOLLOW,
            MLCAuthDriver::User(),
            $this->objEntity
        );
    }
}