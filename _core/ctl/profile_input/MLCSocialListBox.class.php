<?php

class MLCSocialListBox extends MJaxListBox{

    public function __construct($objParentControl, $mixData){
        parent::__construct($objParentControl);
        $this->arrData = $mixData;
        if(array_key_exists('options', $this->arrData)){
            foreach($this->arrData['options'] as $strKey => $strShortDesc){
                $this->AddItem($strShortDesc, $strKey);
            }
        }
    }
    public function GetValue() {
        return $this->SelectedValue;
    }
}