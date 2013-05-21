<?php
class MLCSocialRewriteHandeler extends MLCRewriteHandelerBase{
    public function Handel($strUri){

        $objEntity = MLCNamespaceDriver::Load(
                substr($strUri, 1)
        );

        if(!is_null($objEntity)){
            switch (get_class($objEntity)) {
                case('AuthUser'):

                        MLCSocialProfileForm::SetUser($objEntity);
                        //TODO: Put in check to see if this exists or is defined - use default one if fail
                        return MLCApplication::$strCtlFile = __CTL_ACTIVE_APP_DIR__ . '/profile.php';
                    break;
            }
        }else{
            parent::Handel($strUri);
        }


    }
}