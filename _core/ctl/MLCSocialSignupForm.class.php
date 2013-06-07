<?php
class MLCSocialSignupForm extends MLCForm{
    protected $pnlSignup = null;
    protected $arrEditProfileField = array();
    public $lnkSave = null;
    public $pnlThanks = null;

    public function Form_Create(){
        $this->pnlSignup = new MLCShortSignUpPanel($this, 'pnlSignup');
        $this->pnlSignup->AddAction(
            new MJaxAuthSignupEvent(),
            new MJaxServerControlAction($this, 'pnlSignup_signup')
        );
        $this->pnlSignup->lnkSignup->Style->Display = 'none';

        $arrProfileFieldTypes = MLCSocialDriver::GetProfileFieldTypes();
        foreach ($arrProfileFieldTypes as $strKey => $objProfileFieldType) {
            $this->arrEditProfileField[$objProfileFieldType->Namespace] = new MLCSocialProfileFieldDataEditPanel($this, $objProfileFieldType);

        }
        $this->pnlThanks = new MJaxPanel($this);
        $strTplFile = '_MLCSocialSignupThanksPanel';
        $strFileLoc = __VIEW_ACTIVE_APP_DIR__ . '/www/social/' . $strTplFile . '.tpl.php';
        if(file_exists($strFileLoc)){
            $this->pnlThanks->Template = $strFileLoc;
        }else{
            $this->pnlThanks->Template = __MLC_SOCIAL_CORE_VIEW__ . '/panels/' . $strTplFile . '.tpl.php';
        }


        $this->lnkSave = new MJaxLinkButton($this);
        $this->lnkSave->Text = 'Save';
        $this->lnkSave->AddCssClass('btn');
        $this->lnkSave->AddAction($this, 'lnkSave_click');


    }
    public function lnkSave_click($strFormId, $strControlId, $strActionParameter){
        //$this->pnlSignup->lnkSignup_click($strFormId, $strControlId, $strActionParameter);
        $this->pnlSignup_signup();
    }
    public function pnlSignup_signup(){

        $arrProfileFieldData = array();
        $objUser = MLCAuthDriver::IdUser();
        if(is_null($objUser)){
            $intHackUser = time();
        }else{
            $intHackUser = MLCAuthDriver::IdUser();
        }
        foreach ( $this->arrEditProfileField as $strNamespace => $pnlEditProfileField) {
            $arrProfileFieldData[$strNamespace] = $pnlEditProfileField->Save($intHackUser);
        }
        $this->Alert($this->pnlThanks);
        return $arrProfileFieldData;
    }
}
