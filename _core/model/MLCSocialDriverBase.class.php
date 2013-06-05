<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user1a
 * Date: 5/10/13
 * Time: 2:08 PM
 * To change this template use File | Settings | File Templates.
 */

abstract class MLCSocialDriverBase{
    public static function GetSignupProgress(){
        $intTotalType = MLCSocialProfileFieldType::QueryCount();
        $intTotalData = MLCSocialProfileFieldData::QueryCount();
        return floor($intTotalData/$intTotalType * 100);
    }
    public static function GetProfileFieldTypes($intIdParentField = null){
        $arrFieldTypes = MLCSocialProfileFieldType::Query(
            sprintf(
                'WHERE idParentProfileField IS NULL ORDER BY rank ',
                $intIdParentField
            )
        );
        return $arrFieldTypes;
    }

    public static function GetUserSocialActions($objUser = null){
        if (is_null($objUser)) {
            $objUser = MLCAuthDriver::User();
        }
        return MLCSocialDriver::GetRelatedSocailActions($objUser);

    }

    public static function GetRelatedSocailActions($objEntity){
        $arrSocialActions = MLCSocialAction::Query(
            sprintf(
                'WHERE
                    (toEntityId = %s AND toEntityType ="%s") OR
                    (fromEntityId = %s AND fromEntityType ="%s")
                 ORDER BY creDate DESC',
                $objEntity->getId(),
                get_class($objEntity),
                $objEntity->getId(),
                get_class($objEntity)
            )
        );
        return $arrSocialActions;
    }
    public static function AddSocialAction($strType, BaseEntity $objFromEntity, BaseEntity $objToEntity = null, $mixData = null, $mixParentAction = null){
        $objSocialAction = new MLCSocialAction();
        $objSocialAction->CreDate = MLCDateTime::Now();
        $objSocialAction->IdUser = MLCAuthDriver::IdUser();
        $objSocialAction->Type = $strType;
        if(!is_null($objFromEntity)){
            $objSocialAction->FromEntityId = $objFromEntity->getId();
            $objSocialAction->FromEntityType = get_class($objFromEntity);
        }
        if(!is_null($objToEntity)){
            $objSocialAction->ToEntityId = $objToEntity->getId();
            $objSocialAction->ToEntityType = get_class($objToEntity);
        }
        if(is_string($mixData)){
            $mixData = array(
                'body' => $mixData
            );
        }
        if(is_array($mixData)){
            $objSocialAction->Data = json_encode($mixData);
        }elseif(
            (is_object($mixData)) &&
            (method_exists($mixData, '__toJson'))
        ){
            $objSocialAction->Data = $mixData->__toJson();
        }
        $objSocialAction->Save();
        return $objSocialAction;
    }
    public static function GetProfileFieldData($objUser = null){
        if (is_null($objUser)) {
            $objUser = MLCAuthDriver::User();
        }
        $arrFieldData = MLCSocialProfileFieldData::Query(
            sprintf(
                'WHERE idUser = %s',
                $objUser->IdUser
            )
        );
        $arrReturn = array();
        foreach ($arrFieldData as $strKey => $objFieldData) {
            $arrReturn[$objFieldData->IdProfileFieldData] = $objFieldData;
        }

        return $arrReturn;

    }

    public static function GetRelevantSocialActions(){

    }

    public static function GetRecomendedUsers(){
        //Load current user
        $objUser = MLCAuthDriver::User();
        //Create a query
    }
    public static function ProfileUrl($objUser){

        $strNamespace = MLCNamespaceDriver::GetNamespaceByEntity($objUser);
        if(!is_null($strNamespace)){
            return sprintf('//%s/%s', $_SERVER['SERVER_NAME'], $strNamespace);
        }
        return sprintf('//%s/profile.php?u=%s', $_SERVER['SERVER_NAME'], $objUser->getId());
    }
}