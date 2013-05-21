<?php
class MLCSocialSignupForm extends MLCForm{
    protected $pnlSignup = null;
    protected $arrEditProfileField = array();
    public $lnkSave = null;

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
        $this->lnkSave = new MJaxLinkButton($this);
        $this->lnkSave->Text = 'Save';
        $this->lnkSave->AddCssClass('btn');
        $this->lnkSave->AddAction($this, 'lnkSave_click');


    }
    public function lnkSave_click($strFormId, $strControlId, $strActionParameter){
        $this->pnlSignup->lnkSignup_click($strFormId, $strControlId, $strActionParameter);
    }
    public function pnlSignup_signup(){

        $arrProfileFieldData = array();
        foreach ( $this->arrEditProfileField as $strNamespace => $pnlEditProfileField) {
            $arrProfileFieldData[$strNamespace] = $pnlEditProfileField->Save();
        }
        return $arrProfileFieldData;
    }
}
