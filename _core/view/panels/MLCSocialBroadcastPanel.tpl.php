<?php

class MLCSocialActionPanel extends MLCSocialActionPanelBase{
    public $txtBroadcast = null;
    public $btnSubmit = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);

        $this->strTemplate = __MDE_CORE_VIEW__ . '/' . get_class($this) . '.tpl.php';
        $this->btnSubmit = new MJaxButton($this);
        $this->btnSubmit->Text = 'Submit';
        $this->btnSubmit->AddCssClass('btn');
        $this->btnSubmit->AddAction($this, 'btnSubmit_click');

        $this->txtBroadcast = new MJaxTextBox($this);
        $this->txtBroadcast->TextMode = MJaxTextMode::MultiLine;

    }

    public function btnSubmit_click(){
        MLCSocialDriver::AddSocialAction(
            MLCSocialActionType::COMMENT,
            MLCAuthDriver::User(),
            $this->objEntity,
            $this->txtComment->Text
        );
    }
}