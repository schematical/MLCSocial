<?php

class MLCSocialTextBox extends MJaxTextBox{
    protected $arrData = null;
    public function __construct($objParentControl, $mixData = null)
    {
        parent::__construct($objParentControl);
        $this->arrData = $mixData;
        if(array_key_exists('type', $this->arrData)){
            $this->strTextMode = $this->arrData['type'];
        }


    }
    public function GetValue() {
        return $this->strText;
    }
}