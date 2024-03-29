<?php
class MLCSocialProfileFieldDataEditPanel extends MJaxPanel {
    public $objFieldType = null;
    public $objFieldData = null;
    public $mixCtl = null;

    public $arrData = null;


    public $lnkSubmit = null;
    public function __construct($objParentControl, $objFieldType) {
        parent::__construct($objParentControl);
        $this->objFieldType = $objFieldType;
        $strTplFile = get_class($this);
        $strFileLoc = __VIEW_ACTIVE_APP_DIR__ . '/www/social/' . $strTplFile . '.tpl.php';
        if(file_exists($strFileLoc)){
            $this->strTemplate = $strFileLoc;
        }else{
            $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/panels/' . $strTplFile . '.tpl.php';
        }
        if (!is_null(MLCAuthDriver::IdUser())) {
            $this->objFieldData = MLCSocialProfileFieldData::Query(
                sprintf(
                    'WHERE idProfileFieldType = %s AND idUser = %s',
                    $objFieldType->IdProfileFieldType,
                    MLCAuthDriver::IdUser()
                ),
                true
            );
        }
        if(class_exists($this->objFieldType->CtlType)){
            $strClassName = $this->objFieldType->CtlType;
            $this->mixCtl = new $strClassName($this, _jd($this->objFieldType->OptData));
            if(!is_null($this->objFieldData)){
                $this->mixCtl->Text = $this->objFieldData->Data;
            }
        }else{
            throw new Exception("No field type :" . $this->objFieldType->CtlType);
        }

    }

    public function Save($intHackUser = null){
        if(is_null($this->objFieldData)){
            $this->objFieldData = new MLCSocialProfileFieldData();
            $this->objFieldData->IdProfileFieldType = $this->objFieldType->IdProfileFieldType;
            if(!is_null($intHackUser)){
                $this->objFieldData->IdUser = $intHackUser;
            }else{
                $this->objFieldData->IdUser = MLCAuthDriver::IdUser();
            }

            $this->objFieldData->CreDate = MLCDateTime::Now();
        }
        if(is_null($this->mixCtl)){
            throw new Exception("Field Control cannot be null");
        }
        $strValue = $this->mixCtl->GetValue();
        if(
            ($this->objFieldType->Rank == 1) &&
            (is_null($strValue))
        ){
            return null;
        }
        $this->objFieldData->Data = $strValue;
        $this->objFieldData->Save();
        return $this->objFieldData;
    }

    public function Data($strKey){
        if(array_key_exists($strKey,$this->arrData)){
            return $this->arrData[$strKey];
        }
        return null;
    }
}

