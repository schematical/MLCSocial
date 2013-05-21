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
        $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/panels/' . get_class($this) . '.tpl.php';
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
            $this->mixCtl = new $strClassName($this);
            if(!is_null($this->objFieldData)){
                $this->mixCtl->Text = $this->objFieldData->Data;
            }
        }else{
            die("HIT");
            switch ($this->objFieldType->CtlType) {
                case('blah'):

                    break;
                default:

                    break;
            }
        }

    }

    public function Save(){
        if(is_null($this->objFieldData)){
            $this->objFieldData = new MLCSocialProfileFieldData();
            $this->objFieldData->IdProfileFieldType = $this->objFieldType->IdProfileFieldType;
            $this->objFieldData->IdUser = MLCAuthDriver::IdUser();
            $this->objFieldData->CreDate = MLCDateTime::Now();
        }
        $strValue = $this->mixCtl->Text;
        if(
            ($this->objFieldType->Rank == 1) &&
            (strlen($strValue) == 0)
        ){
            return null;
        }
        $this->objFieldData->Data = $this->mixCtl->Text;
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

