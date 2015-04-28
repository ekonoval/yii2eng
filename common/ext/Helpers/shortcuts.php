<?php

/**
 * @return \yii\web\Request
 */
function yR()
{
    return Yii::$app->request;
}

/**
 * @return \yii\db\Connection
 */
function yDb()
{
    return Yii::$app->db;
}

/**
 * @return \yii\web\Session
 */
function ySession()
{
    return Yii::$app->session;
}