<h1>MLCSocial Admin</h1>
<?php foreach($this->arrFieldPanels as $strNamespace => $pnlField){
    $pnlField->Render();
}