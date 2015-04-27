<?php

/**
 * @return \yii\web\Request
 */
function yR()
{
    return Yii::$app->request;
}

/**
 * @return \yii\web\Session
 */
function ySession()
{
    return Yii::$app->session;
}