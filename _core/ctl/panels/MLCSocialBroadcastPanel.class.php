<?php

class MLCSocialBroadcastPanel extends MLCSocialActionPanelBase{
    public $txtBroadcast = null;
    public $btnSubmit = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);

        $this->btnSubmit = new MJaxButton($this);
        $this->btnSubmit->Text = 'Submit';
        $this->btnSubmit->AddCssClass('btn');
        $this->btnSubmit->AddAction($this, 'btnSubmit_click');

        $this->txtBroadcast = new MJaxTextBox($this);
        $this->txtBroadcast->TextMode = MJaxTextMode::MultiLine;

    }

    public function btnSubmit_click(){
        $objSA = MLCSocialDriver::AddSocialAction(
            MLCSocialActionType::BROADCAST,
            MLCAuthDriver::User(),
            $this->objEntity,
            $this->txtBroadcast->Text
        );
        $this->txtBroadcast->Text = '';
        if(method_exists($this->objParentControl, 'pnlBroadcast_submit')){
            $this->objParentAction->pnlBroadcast_submit($objSA);
        }
        if(method_exists($this->objForm, 'pnlBroadcast_submit')){
            $this->objForm->pnlBroadcast_submit($objSA);
        }
    }
}