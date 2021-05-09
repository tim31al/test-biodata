<?php


namespace common\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * FbUser model
 *
 * @property integer $id
 * @property integer $bonus_id
 * @property integer $created_at
 */
class FbUser extends ActiveRecord implements IdentityInterface
{
    const SESSION_KEY_PREFIX = 'fb-user';

    private ?string $email;
    private string $name;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => strtotime('now'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%fb_user}}';
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        $identity = static::findOne(['id' => $id]);
        if ($identity && \Yii::$app->getSession()->has(self::getSessionKey($id))) {
            $user = \Yii::$app->getSession()->get(self::getSessionKey($id));

            try {
                $identity
                    ->setEmail($user['email'])
                    ->setName($user['name']);
            } catch (\Exception $e) {
            }
        }

        return $identity;
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = \Yii::$app->params['api-user'];
        return $user['token'] === $token ? new self : false;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @return string
     */
    public function getFirstname(): string
    {
        list($firstname) = explode(' ', $this->getName());
        return $firstname ?? '';
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get FbUser from authclient Facebook
     * @param array $userAttributes
     * @return \common\models\FbUser
     */
    public static function getUser(array $userAttributes): self
    {
        $fbUser = self::findOne(['id' => $userAttributes['id']]);

        if (!$fbUser) {
            $fbUser = new FbUser();
            $fbUser->id = (int)$userAttributes['id'];

            $fbUser->save();
        }

        try {
            $fbUser
                ->setName($userAttributes['name'])
                ->setEmail($userAttributes['email']);
        } catch (\Exception $e) {
        }

        return $fbUser;
    }

    public function toStore(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
        ];
    }

    public static function getSessionKey($id): string
    {
        return self::SESSION_KEY_PREFIX . ':' . $id;
    }

    public function getBonus(): ActiveQuery
    {
        return $this->hasOne(Bonus::class, ['id' => 'bonus_id']);
    }

    public function setBonus(?Bonus $bonus): self
    {
        if (!$bonus) {
            return $this;
        }

        $this->link('bonus', $bonus);
        return $this;
    }

}
