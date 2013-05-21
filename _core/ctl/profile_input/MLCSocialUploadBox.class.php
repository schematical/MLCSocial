<?php
MLCApplication::InitPackage('MLCAws');
class MLCSocialUploadBox extends MJaxS3UploadBox{
    protected $arrData = null;
    public function __construct($objParentControl, $mixData = null){
        parent::__construct($objParentControl);
        $this->arrData = $mixData;
        $this->strS3Path = 'social/' . MLCAuthDriver::IdUser() . '/' . time();

    }
    public function GetValue() {
        return $this->S3FullPath;
    }
}