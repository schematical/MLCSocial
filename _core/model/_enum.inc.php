<?php
abstract class MLCSocialActionType{
    const LIKE = 'LIKE';
    const COMMENT = 'COMMENT';
    const BROADCAST = 'BROADCAST';
    const FOLLOW = 'FOLLOW';
}
abstract class MLCSocialQS{
    const IdUser = 'u';
}