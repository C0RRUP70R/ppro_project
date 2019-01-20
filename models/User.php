<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $role;


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return new static(Employee::loadToArray(Employee::findOne($id)));
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     */
    public static function findByUsername($username)
    {
        $emp = Employee::find()->where(['username' => $username])->one();

        return new static(Employee::loadToArray($emp));

    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    /**
     * Check if user is Manager
     * @return bool
     */
    public function isManager()
    {
        return $this->isAdmin() || $this->role === Role::findByName('manager')->emp_role_pk;
    }

    /**
     * Check if user is admin
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role == Role::findByName('admin')->emp_role_pk;
    }
}
