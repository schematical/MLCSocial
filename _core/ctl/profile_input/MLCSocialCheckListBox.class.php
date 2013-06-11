<?php

class MLCSocialCheckListBox extends MJaxPanel{
    public $arrData = array();
    public $arrCheckBoxs = array();
    public function __construct($objParentControl, $mixData)
    {
        parent::__construct($objParentControl);
        $this->arrData = $mixData;
        if(array_key_exists('options', $this->arrData)){
            foreach($this->arrData['options'] as $strKey => $strShortDesc){
                $this->arrCheckBoxs[$strKey] = new MJaxCheckBox($this);
                $this->arrCheckBoxs[$strKey]->ActionParameter = $strKey;
                $this->arrCheckBoxs[$strKey]->Attr('title', $strShortDesc);
                $this->arrCheckBoxs[$strKey]->Name = $this->strControlId;
            }
        }
        $strTplFile = get_class($this);
        $strFileLoc = __VIEW_ACTIVE_APP_DIR__ . '/www/social/' . $strTplFile . '.tpl.php';
        if(file_exists($strFileLoc)){
            $this->strTemplate = $strFileLoc;
        }else{
            $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/panels/profile_input/' . $strTplFile . '.tpl.php';
        }

    }
    public function GetValue() {
        $arrReturn = array();
        foreach($this->arrCheckBoxs as $strKey => $chkBox){
            if($chkBox->Checked){
                $arrReturn[] = $strKey;
            }
        }
        return implode('|', $arrReturn);
    }

}
