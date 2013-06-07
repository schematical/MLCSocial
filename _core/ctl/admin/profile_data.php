<?php
class index extends MJaxForm{
    protected $tblProfileData = null;
    protected $arrRows = array();
    public function Form_Create(){
        $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/admin/profile_data.tpl.php';

        $this->tblProfileData = new MJaxTable($this, 'tblProfileData');

        $arrProfileType = MLCSocialProfileFieldType::Query('ORDER BY rank');
        foreach($arrProfileType as $intIndex => $objType){
            $this->tblProfileData->AddColumn(
                $objType->Namespace,
                $objType->IdProfileFieldType

            );
        }
        $arrProfileData = MLCSocialProfileFieldData::LoadAll()->getCollection();
        foreach($arrProfileData as $intIndex => $objProfileData){
            if(!array_key_exists($objProfileData->IdUser, $this->arrRows)){
                $this->arrRows[$objProfileData->IdUser] = $this->tblProfileData->AddRow();
            }
            $this->arrRows[$objProfileData->IdUser]->AddData(
                $objProfileData->Data,
                $objProfileData->IdProfileFieldType
            );
        }

    }
    public static function _csv(){
        $arrResponse = array();

        $arrProfileType = MLCSocialProfileFieldType::Query('ORDER BY rank');
        foreach($arrProfileType as $intIndex => $objType){
            $arrIndex[$objType->IdProfileFieldType] = $objType->Namespace;
        }

        $arrProfileData = MLCSocialProfileFieldData::LoadAll()->getCollection();
        foreach($arrProfileData as $intIndex => $objProfileData){
            if(!array_key_exists($objProfileData->IdUser, $arrResponse)){
                $arrResponse[$objProfileData->IdUser] = array();
            }
            if(array_key_exists($objProfileData->IdProfileFieldType, $arrIndex)){
                $arrResponse[$objProfileData->IdUser][$arrIndex[$objProfileData->IdProfileFieldType]] = $objProfileData->Data;
            }
        }

        $arrResponseFinnal = array();
        $arrResponseFinnal[0] = implode(',', $arrIndex);
        foreach($arrResponse as $intIdUser => $arrProfileData){
            $arrResponseFinnal[$intIdUser] = implode(',', $arrProfileData);
        }
        $strResponse = implode("\n", $arrResponseFinnal);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"profile_data.csv\";" );
        header("Content-Transfer-Encoding: binary");
        die($strResponse);

    }
}
if(array_key_exists('download', $_GET)){
    index::_csv();
}else{
    index::Run('index');
}
