<?php

class MLCSocialUserListPanel extends MLCSocialActionPanelBase{
    public $arrUserPanels = null;
    public $lnkSeeMore = null;
    public function __construct($objParentControl, $strControlId = null, $arrUsers = null)
    {
        parent::__construct($objParentControl, $strControlId);
        if (!is_null($arrUsers)) {
            $arrUsers = $arrUsers;
        }else{
            $arrUsers = MLCSocialDriver::GetRecomendedUsers();
        }
        foreach ($arrUsers as $intIndex => $objUser) {
            $this->arrUserPanels[] = new MLCSocialUserDisplayPanel($this, null, $objUser);
        }

        $this->lnkSeeMore = new MJaxLinkButton($this);
        $this->lnkSeeMore->Text = 'See more';
        $this->lnkSeeMore->AddCssClass('btn');
        $this->lnkSeeMore->AddAction($this, 'lnkSeeMore_click');


    }

    public function lnkSeeMore_click()
    {

    }
}