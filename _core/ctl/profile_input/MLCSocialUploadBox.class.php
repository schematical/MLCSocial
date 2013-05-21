<?php
MLCApplication::InitPackage('MLCAws');
class MLCSocialUploadBox extends MJaxS3UploadBox{

    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strS3Path = 'social/' . MLCAuthDriver::IdUser() . '/' . time();


    }
    public function GetValue() {
        return $this->S3FullPath;
    }
}