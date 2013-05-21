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
        $arrProfileFieldTypes = MLCSocialDriver::GetProfileFieldTypes();
        foreach ($arrProfileFieldTypes as $strKey => $objProfileFieldType) {
            $this->arrEditProfileField[$objProfileFieldType->Namespace] = new MLCSocialProfileFieldDataEditPanel($this, $objProfileFieldType);
        }
        $this->lnkSave = new MJaxLinkButton($this);
        $this->lnkSave->Text = 'Save';
        $this->lnkSave->AddCssClass('btn');
        $this->lnkSave->AddAction($this, 'lnkSave_click');


    }
    public function pnlSignup_signup(){

    }
    public function lnkSave_click(){
        $arrProfileFieldData = array();
        foreach ( $this->arrEditProfileField as $strNamespace => $pnlEditProfileField) {
            $arrProfileFieldData[$strNamespace] = $pnlEditProfileField->Save();
        }
        return $arrProfileFieldData;
    }
}
