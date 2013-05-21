<?php

class MLCSocialFeedDisplayPanel extends MLCSocialActionPanelBase
{
    public $arrSocialActionPanels = array();

    public function __construct($objParentControl, $strControlId = null, $arrSocialActions = null){
        parent::__construct($objParentControl, $strControlId);
        $this->Refresh($arrSocialActions);


    }
    public function Refresh($arrSocialActions = null){
        foreach ($this->arrSocialActionPanels as $intIndex => $pnlSA) {
            $pnlSA->Remove();
            unset($this->arrSocialActionPanels[$intIndex]);
        }

        if (is_null($arrSocialActions)) {
            $arrSocialActions = MLCSocialDriver::GetRelevantSocialActions();
        }

        foreach ($arrSocialActions as $strKey => $objSocialAction) {
            $this->arrSocialActionPanels[] = new MLCSocialActionDisplayPanel($this, null, $objSocialAction);
        }
    }

}