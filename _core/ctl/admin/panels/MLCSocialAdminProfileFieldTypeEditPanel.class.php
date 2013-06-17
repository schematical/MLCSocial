<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - MLCSocialProfileFieldTypeEditPanel extends MLCSocialProfileFieldTypeEditPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/MLCSocialProfileFieldTypeEditPanelBase.class.php");
class MLCSocialAdminProfileFieldTypeEditPanel extends MLCSocialProfileFieldTypeEditPanelBase {
    public $lnkEdit = null;
    public $pnlData = null;
    public $pnlPreview = null;
    public function __construct($objParentControl, $objMLCSocialProfileFieldType = null) {
        parent::__construct($objParentControl, $objMLCSocialProfileFieldType);
        $this->SetEditMode(false);
        $this->txtRank = new MJaxListBox($this);
        for($i = 0; $i <= 10; $i ++){
            $this->txtRank->AddItem($i, $i, ($i == 1));
        }
        $strType = null;

        if(!is_null($this->objMLCSocialProfileFieldType)){
            $this->txtShortDesc->Text = htmlentities($this->objMLCSocialProfileFieldType->ShortDesc, ENT_QUOTES);;
            $strType = $this->objMLCSocialProfileFieldType->CtlType;
            if(strlen($strType) == 0){
                $strType = null;
            }
        }

        $this->txtCtlType = new MJaxListBox($this);
        $this->txtCtlType->AddItem('text', 'MLCSocialTextBox', ((is_null($strType)) || ($strType == 'MLCSocialTextBox')));
        $this->txtCtlType->AddItem('upload', 'MLCSocialUploadBox', ($strType == 'MLCSocialUploadBox'));
        $this->txtCtlType->AddItem('check', 'MLCSocialCheckListBox', ($strType == 'MLCSocialCheckListBox'));
        $this->txtCtlType->AddItem('radio', 'MLCSocialRadioListBox', ($strType == 'MLCSocialRadioListBox'));
        $this->txtCtlType->AddItem('list', 'MLCSocialListBox', ($strType == 'MLCSocialListBox'));

        $this->txtCtlType->AddAction(
            new MJaxChangeEvent(),
            new MJaxServerControlAction(
                $this,
                'txtCtlType_change'
            )
        );
        $this->UpdateEditDataPanel();

        $this->lnkEdit = new MJaxLinkButton($this);
        $this->lnkEdit->Text = 'Edit';
        $this->lnkEdit->AddAction($this, 'lnkEdit_click');
        $this->txtOptData->TextMode = MJaxTextMode::MultiLine;
    }
    public function UpdateEditDataPanel(){

        switch($this->txtCtlType->SelectedValue){
            case('MLCSocialTextBox'):
            case('MLCSocialUploadBox'):

            break;
            case('MLCSocialCheckListBox'):
            case('MLCSocialRadioListBox'):
            case('MLCSocialListBox'):
                $this->pnlData = new MLCSocialListBoxEditPanel(
                    $this,
                    json_decode(
                        $this->txtOptData->Text,
                        true
                    )
                );
            break;
        }
        if(!is_null($this->objMLCSocialProfileFieldType)){
            $this->objMLCSocialProfileFieldType->ctlType = $this->txtCtlType->SelectedValue;
            $this->pnlPreview = new MLCSocialProfileFieldDataEditPanel($this, $this->objMLCSocialProfileFieldType);
        }
    }
    public function txtCtlType_change(){
        $this->UpdateEditDataPanel();
    }
    public function lnkEdit_click(){
        $this->objForm->HideAll();
        $this->SetEditMode(true);
    }
    public function btnSave_click() {
        $blnNew = (is_null($this->objMLCSocialProfileFieldType));
        if(!is_null($this->pnlData)){
            $arrData = $this->pnlData->GetData();
            $this->txtOptData->Text = json_encode($arrData, JSON_PRETTY_PRINT);

        }
        if (is_null($this->objMLCSocialProfileFieldType)) {
            //Create a new one
            $this->objMLCSocialProfileFieldType = new MLCSocialProfileFieldType();
        }
        $this->objMLCSocialProfileFieldType->ctlType = $this->txtCtlType->SelectedValue;
        $this->objMLCSocialProfileFieldType->IdParentProfileField = null;
        $this->objMLCSocialProfileFieldType->namespace = $this->txtNamespace->Text;
        $this->objMLCSocialProfileFieldType->shortDesc = $this->txtShortDesc->Text;
        $this->objMLCSocialProfileFieldType->longDesc = $this->txtLongDesc->Text;
        $this->objMLCSocialProfileFieldType->creDate = $this->txtCreDate->Text;
        $this->objMLCSocialProfileFieldType->rank = $this->txtRank->Text;
        $this->objMLCSocialProfileFieldType->optData = $this->txtOptData->Text;
        $this->objMLCSocialProfileFieldType->section = $this->txtSection->Text;
        $this->objMLCSocialProfileFieldType->Save();

        if($blnNew){
            $this->SetEditMode(false);
        }
    }



    public function SetEditMode($blnEditMode){
        if($blnEditMode){
            $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/admin/panels/MLCSocialProfileFieldTypeEditPanelBase_edit.tpl.php';
        }else{
            $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/admin/panels/MLCSocialProfileFieldTypeEditPanelBase.tpl.php';
        }
    }
}
?>