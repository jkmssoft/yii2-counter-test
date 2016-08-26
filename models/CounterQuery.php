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

/**
 * This is the ActiveQuery class for [[Counter]].
 *
 * @see Counter
 */
class CounterQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Counter[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Counter|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
