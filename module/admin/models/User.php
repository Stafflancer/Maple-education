<?php
/**
 * User model class file.
 */

namespace app\module\admin\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $user_id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property int $role
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property string $password write-only password
 * @property string $isSuperAdmin
 * @property string $isAdmin
 * @property string $isUser
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $newPassword;

    const ROLE_SUPER_ADMIN = 0;
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email', 'phone', 'role', 'status'], 'required'],
            [['newPassword'], 'required', 'on' => 'create'],
            ['newPassword', 'string', 'min' => 6],
            [['address'], 'string', 'max' => 5000],
            [['email'], 'email'],
            [['status', 'role'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_NOT_ACTIVE, self::STATUS_ACTIVE]],
            ['role', 'default', 'value' => self::ROLE_ADMIN],
            ['role', 'in', 'range' => [self::ROLE_SUPER_ADMIN, self::ROLE_ADMIN, self::ROLE_USER]],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'newPassword'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['auth_key'], 'default', 'value' => Yii::$app->security->generateRandomString()],
            [['username', 'email', 'phone', 'password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" не реализован.');
    }

    /**
     * Finds user by username.
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email.
     *
     * @param string $email user email
     * @return static|null User instance
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token.
     *
     * @param string $token password reset token
     * @return static|null user data
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid.
     *
     * @param string $token password reset token
     * @return bool whether password reset token is valid
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * Validates password.
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password password to set
     * @throws \yii\base\Exception on bad password parameter
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID пользователя',
            'username' => Yii::t('user', 'Имя пользователя'),
            'auth_key' => 'Auth Key',
            'newPassword' => Yii::t('user', 'Пароль'),
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => Yii::t('user', 'E-mail'),
            'phone' => Yii::t('user', 'Номер телефона'),
            'address' => Yii::t('user', 'Адрес'),
            'role' => 'Роль',
            'status' => 'Статус',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @return bool whether user role is 'Super Admin'
     */
    public function getIsSuperAdmin()
    {
        return $this->role == self::ROLE_SUPER_ADMIN;
    }

    /**
     * @return bool whether user role is 'Admin'
     */
    public function getIsAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

    /**
     * @return bool whether user role is 'User'
     */
    public function getIsUser()
    {
        return $this->role == self::ROLE_USER;
    }

    /**
     * Returns roles list.
     *
     * @return array roles list data
     */
    public static function getRolesList()
    {
        return [
            self::ROLE_SUPER_ADMIN => 'Super Admin',
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_USER => 'User',
        ];
    }

    /**
     * Returns role name by specified role constant.
     *
     * @param integer $role role constant
     * @return mixed|string role name
     */
    public static function getRoleName($role)
    {
        $roles = self::getRolesList();

        return isset($roles[$role]) ? $roles[$role] : Yii::t('app', 'Неопределено');
    }

    /**
     * Returns statuses list.
     *
     * @return array statuses list data
     */
    public static function getStatusesList()
    {
        return [
            self::STATUS_ACTIVE => 'Включено',
            self::STATUS_NOT_ACTIVE => 'Отключено'
        ];
    }

    /**
     * Returns status name by specified status constant.
     *
     * @param integer $status status constant
     * @return mixed|string status name
     */
    public static function getStatusName($status)
    {
        $statuses = self::getStatusesList();
        return isset($statuses[$status]) ? $statuses[$status] : 'Неопределено';
    }

    /**
     * Returns all User models count.
     *
     * @return int|string User models count.
     */
    public static function getAllCount()
    {
        return self::find()->count();
    }

    /**
     * Returns users list with role 'user'.\
     *
     * @return array users list
     */
    public static function getUsersList()
    {
        $result = [];

        $users = self::getAllByRole(self::ROLE_USER);

        foreach ($users as $user) {
            $result[$user['user_id']] = $user['username'];
        }

        return $result;
    }

    /**
     * Returns all user with specified role.
     *
     * @param int $role user role
     * @return array users list
     */
    public static function getAllByRole($role)
    {
        return (new Query())
            ->select(['user_id', 'username', 'email', 'phone', 'address', 'role', 'status', 'created_at', 'updated_at'])
            ->from(self::tableName())
            ->where(['role' => $role])
            ->orderBy('username ASC')
            ->all();
    }

    /**
     * Returns user data by specified user id.
     *
     * @param int $userId user id
     * @return array|bool user data
     */
    public static function getById($userId)
    {
        return (new Query())
            ->select(['user_id', 'username', 'email', 'phone', 'address', 'role', 'status', 'created_at', 'updated_at'])
            ->from(self::tableName())
            ->where(['user_id' => $userId])
            ->one();
    }
}
