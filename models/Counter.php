<?php

/*
 * This file is part of the yii2-counter project.
 *
 * (c) jkmssoft <http://github.com/jkmssoft/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jkmssoft\counter\models;

use Yii;
use yii\db\Connection;
use yii\db\Expression;
use yii\db\Query;
use yii\di\Instance;

/**
 * This is the model class for table "{{%counter}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $counter
 * @property integer $visible
 * @property integer $created_at
 * @property integer $updated_at
 *
 */
class Counter extends \yii\db\ActiveRecord
{
    /**
     * @type \yii\db\Connection;
     */
    public $db = 'db';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::className());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%counter}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['counter'], 'integer'],
            [['visible'], 'integer', 'min' => 0, 'max' => 1],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['name', 'counter'], 'required'],
        ];
    }

    const INCREASE = true;
    const DECREASE = false;

    /**
     * Increase counter.
     * @param string $name The name of the item in the database table.
     * @return integer|null new value or null on error.
     * @access public
     */
    public function increase($name)
    {
        return $this->doUpdate($name, self::INCREASE);
    }

    /**
     * Decrease counter.
     * @param string $name The name of the item in the database table.
     * @return integer|null new value or null on error.
     * @access public
     */
    public function decrease($name)
    {
        return $this->doUpdate($name, self::DECREASE);
    }

    /**
     * Increase or decrease the counter. Find it by its name and return new counter value on success.
     * If counter does not exist create it.
     * @param string $name The name of the counter.
     * @param boolean $increase true/false
     * @return integer|null new value or null on error.
     * @access private
     */
    private function doUpdate($name, $increase)
    {
        try {
            // see https://github.com/yiisoft/yii2/issues/5138#issuecomment-97088457
            $db = Yii::$app->db;
            $sql = $db->queryBuilder->batchInsert(
                $this->tableName(),
                ['counter', 'name', 'created_at', 'updated_at'],
                [[$increase ? 1 : -1, $name, time(), 0]]
            );

            $sql .= ' ON DUPLICATE KEY UPDATE updated_at='.time().', ';
            if ($increase) {
                $sql .= 'counter=counter+1';
            } else {
                $sql .= 'counter=counter-1';
            }

            $db->createCommand($sql)->execute();

            return $this->getCount($name);
        } catch (\Exception $e) {
            if ($increase) {
                Yii::warning('increase of counter '.$name.' failed');
            } else {
                Yii::warning('decrease of counter '.$name.' failed');
            }
        }
        return null;
    }

    /**
     * Exists this counter?
     * @param integer $name The name of the counter.
     * @return boolean True if the counter exists else false.
     */
    public function exists($name)
    {
        return self::find()->where('name = :name', [':name' => $name])->exists();
    }

    /**
     * Get the actual count by name.
     * @param string $name The name of the counter.
     * @return integer|null value or null on error.
     */
    public function getCount($name)
    {
        $counter = self::find()->where('name = :name', [':name' => $name])->one();
        if ($counter != null) {
            return $counter->counter;
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     * @see http://www.yiiframework.com/doc-2.0/yii-db-baseactiverecord.html#beforeSave%28%29-detail
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // insert
            $this->created_at = time();
        } else {
            // update
            $this->updated_at = time();
        }

        return true; // do update/insert continue
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('counter', 'ID'),
            'name' => Yii::t('counter', 'Name'),
            'counter' => Yii::t('counter', 'Counter'),
            'visible' => Yii::t('counter', 'Visible'),
            'created_at' => Yii::t('counter', 'Created At'),
            'updated_at' => Yii::t('counter', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return CounterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CounterQuery(get_called_class());
    }
}
