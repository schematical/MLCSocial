<?php

class MLCSocialTextBox extends MJaxTextBox{

    public function __construct($objParentControl, $strControlId = null)
    {
        parent::__construct($objParentControl, $strControlId);



    }
    public function GetValue() {
        return $this->strText;
    }
}