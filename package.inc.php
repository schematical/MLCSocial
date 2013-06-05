<?php
define('__MLC_SOCIAL__', dirname(__FILE__));
define('__MLC_SOCIAL_CORE__', __MLC_SOCIAL__ . '/_core');


define('__MLC_SOCIAL_CORE_CTL__', __MLC_SOCIAL_CORE__ . '/ctl');
define('__MLC_SOCIAL_CORE_MODEL__', __MLC_SOCIAL_CORE__ . '/model');
define('__MLC_SOCIAL_CORE_VIEW__', __MLC_SOCIAL_CORE__ . '/view');
define('__MLC__SOCIAL_CG__', __MLC_SOCIAL__ . '/_codegen');
MLCApplicationBase::$arrClassFiles['MLCSocialDriver'] = __MLC_SOCIAL__ . '/MLCSocialDriver.class.php';



MLCApplicationBase::$arrClassFiles['MLCSocialDriverBase'] = __MLC_SOCIAL_CORE_MODEL__ . '/MLCSocialDriverBase.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialRewriteHandeler'] = __MLC_SOCIAL_CORE_MODEL__ . '/MLCSocialRewriteHandeler.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialUser'] = __MLC_SOCIAL_CORE_MODEL__ . '/data_layer/MLCSocialUser.class.php';

//Ctl
MLCApplicationBase::$arrClassFiles['MLCSocialSignupForm'] = __MLC_SOCIAL_CORE_CTL__ . '/MLCSocialSignupForm.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialProfileFieldDataEditPanel'] = __MLC_SOCIAL_CORE_CTL__ . '/panels/MLCSocialProfileFieldDataEditPanel.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialProfileForm'] = __MLC_SOCIAL_CORE_CTL__ . '/MLCSocialProfileForm.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialFeedDisplayPanel'] = __MLC_SOCIAL_CORE_CTL__ . '/panels/MLCSocialFeedDisplayPanel.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialActionDisplayPanel'] = __MLC_SOCIAL_CORE_CTL__ . '/panels/MLCSocialActionDisplayPanel.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialLikeButton'] = __MLC_SOCIAL_CORE_CTL__ . '/panels/MLCSocialLikeButton.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialActionPanelBase'] = __MLC_SOCIAL_CORE_CTL__ . '/panels/MLCSocialActionPanelBase.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialBroadcastPanel'] = __MLC_SOCIAL_CORE_CTL__ . '/panels/MLCSocialBroadcastPanel.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialUserListPanel'] = __MLC_SOCIAL_CORE_CTL__ . '/panels/MLCSocialUserListPanel.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialUserDisplayPanel'] = __MLC_SOCIAL_CORE_CTL__ . '/panels/MLCSocialUserDisplayPanel.class.php';
//CTL //PROFILE INPUTS
MLCApplicationBase::$arrClassFiles['MLCSocialUploadBox'] = __MLC_SOCIAL_CORE_CTL__ . '/profile_input/MLCSocialUploadBox.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialListBox'] = __MLC_SOCIAL_CORE_CTL__ . '/profile_input/MLCSocialListBox.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialTextBox'] = __MLC_SOCIAL_CORE_CTL__ . '/profile_input/MLCSocialTextBox.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialTextArea'] = __MLC_SOCIAL_CORE_CTL__ . '/profile_input/MLCSocialTextArea.class.php';
MLCApplicationBase::$arrClassFiles['MLCSocialCheckListBox'] = __MLC_SOCIAL_CORE_CTL__ . '/profile_input/MLCSocialCheckListBox.class.php';


require_once(__MLC_SOCIAL_CORE_MODEL__ . '/_enum.inc.php');
