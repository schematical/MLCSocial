<?php
class MLCSocialListBoxEditPanel extends MJaxPanel{
    protected $arrData = null;
    public $txtName = null;
    public $txtValue = null;
    public $btnAddNew = null;
    public function __construct($objParentControl, $arrData){
        parent::__construct($objParentControl);
        $this->arrData = $arrData;
        $this->strTemplate = __MLC_SOCIAL_CORE_VIEW__ . '/admin/panels/profile_filed_type_opts/' . get_class($this) . '.tpl.php';
        $this->btnAddNew = new MJaxLinkButton($this);
        $this->btnAddNew->Text = 'Add';
        $this->btnAddNew->AddAction($this, 'btnAddNew_click');
        $this->btnAddNew->AddCssClass('btn');

        $this->txtName = new MJaxTextBox($this);
        $this->txtName->Attr('placeholder', 'Name');
        $this->txtValue = new MJaxTextBox($this);
        $this->txtValue->Attr('placeholder', 'Value');
    }
    public function btnAddNew_click(){
        if(!array_key_exists('options', $this->arrData)){
            $this->arrData['options'] = array();
        }
        $this->arrData['options'][$this->txtValue->Text] = $this->txtName->Text;

        $this->objParentControl->btnSave_click();
    }
    public function GetData(){
        return $this->arrData;
    }
}