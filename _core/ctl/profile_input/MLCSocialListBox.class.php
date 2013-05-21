<?php

class MLCSocialListBox extends MJaxListBox{

    public function __construct($objParentControl, $strControlId = null)
    {
        parent::__construct($objParentControl, $strControlId);



    }
    public function GetValue() {
        return $this->SelectedValue;
    }
}