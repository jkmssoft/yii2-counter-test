<?php

/*
 * This file is part of the yii2-counter project.
 *
 * (c) jkmssoft <http://github.com/jkmssoft/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jkmssoft\counter\components;

use Yii;
use jkmssoft\counter\models\Counter as CounterModel;

/**
 * Component.
 * Provides methods for counter use.
 */
class Counter extends \yii\base\Component
{
    /**
     * @var \jkmssoft\counter\models\Counter Contains instance of counter model.
     */
    protected $counterModel;

    /**
     * @inheritdoc
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->counterModel = new CounterModel();
    }

    /**
     * Increase counter. Find it by its name and return new counter value on success.
     * Create counter if it does not exist.
     * @param string $name The name of the counter.
     * @return integer|null new value or null on error.
     * @access public
     */
    public function increase($name)
    {
        return $this->counterModel->increase($name);
    }

    /**
     * Decrease counter. Find it by its name and return new counter value on success.
     * Create counter if it does not exist.
     * @param string $name The name of the counter.
     * @return integer|null new value or null on error.
     * @access public
     */
    public function decrease($name)
    {
        return $this->counterModel->decrease($name);
    }

    /**
     * Get the actual count by name.
     * @param string $name The name of the counter.
     * @return integer|null value or null on error.
     */
    public function getCount($name)
    {
        return $this->counterModel->getCount($name);
    }

    /**
     * Exists this counter?
     * @param integer $name The name of the counter.
     * @return boolean True if the counter exists else false.
     */
    public function exists($name)
    {
        return $this->counterModel->exists($name);
    }
}
