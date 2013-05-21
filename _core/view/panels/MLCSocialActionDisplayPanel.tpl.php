<?php

class MLCSocialActionDisplayPanel extends MLCSocialActionPanelBase{
    public $lnkLike = null;

    public function __construct($objParentControl, $strControlId = null, $objSocialAction = null)
    {
        parent::__construct($objParentControl, $strControlId);
        $this->objSocialAction = $objSocialAction;
        $this->strTemplate = __MDE_CORE_VIEW__ . '/' . get_class($this) . '.tpl.php';
        $this->lnkLike = new MJaxLinkButton($this);
        $this->lnkLike->Text = 'Submit';
        $this->lnkLike->AddCssClass('btn');



    }
}