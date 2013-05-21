<?php

class MLCSocialTextArea extends MJaxTextBox{

    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);

        $this->strTextMode = MJaxTextMode::MultiLine;

    }
    public function GetValue() {
        return $this->strText;
    }
}