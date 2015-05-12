<?php

/**
 * @return \yii\web\Application
 */
function yApp()
{
    return Yii::$app;
}

/**
 * @return \yii\web\User
 */
function yUser()
{
    return Yii::$app->user;
}

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