<?php
class MLCSocialProfileForm extends MLCForm
{
    protected static $objUser = null;
    public $arrProfileData = null;
    public $pnlFeed = null;
    
    public function Form_Create()
    {
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/profile.tpl.php';
        if(array_key_exists(MLCSocialQS::IdUser,$_GET)){
            $intIdUser = $_GET[MLCSocialQS::IdUser];
            self::$objUser = MLCSocialUser::LoadById($intIdUser);
            if(is_null(self::$objUser)){
                mlc_show_error_page(404);
            }
        }
        $arrSocialActions = MLCSocialDriver::GetUserSocialActions();
        $this->pnlFeed = new MLCSocialFeedDisplayPanel($this, 'pnlFeed', $arrSocialActions);

    }

    public function InitProfileData(){
        $this->arrProfileData = MLCSocialDriver::GetProfileFieldData(self::$objUser);
    }
    public function InitProfileFields(){

    }
    public function RenderProfileData($intKey){
        if(is_null($this->arrProfileData)){
            $this->InitProfileData();
        }
        echo $this->arrProfileData[$intKey]->Data;
    }
    public static function SetUser(AuthUser $objUser){
        self::$objUser = $objUser;
    }
}