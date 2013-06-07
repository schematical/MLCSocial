<?php
class index extends MJaxForm{

    protected $arrFieldPanels = array();

    public function Form_Create(){
        $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/admin/profile_fields.tpl.php';


        $arrProfileType = MLCSocialProfileFieldType::Query('WHERE idParentProfileField IS NULL ORDER BY rank');
        foreach($arrProfileType as $intIndex => $objType){
            $this->arrFieldPanels[$objType->Namespace] = new MLCSocialAdminProfileFieldTypeEditPanel($this, $objType);
        }
        $this->AddEmpty();
        $this->blnSkipMainWindowRender = false;
        $this->blnForceRenderFormState = false;

    }
    public function AddEmpty(){
        if(array_key_exists(-1, $this->arrFieldPanels)){
            $this->arrFieldPanels[$this->arrFieldPanels[-1]->txtNamespace->Text] = $this->arrFieldPanels[-1];
        }
        $this->arrFieldPanels[-1] = new MLCSocialAdminProfileFieldTypeEditPanel($this);
        $this->arrFieldPanels[-1]->txtShortDesc->Text = 'New';
        $this->arrFieldPanels[-1]->txtSection->Text = 'MAIN';
        $this->arrFieldPanels[-1]->txtOptData->Text = "{\n\n}";
        $this->arrFieldPanels[-1]->SetEditMode(true);

    }
    public function HideAll(){
        foreach($this->arrFieldPanels as $intIndex => $pnlField){
            $pnlField->SetEditMode(false);
        }
    }
}
index::Run('index');

