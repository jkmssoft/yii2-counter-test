<?php

/*
 * This file is part of the yii2-counter project.
 *
 * (c) jkmssoft <http://github.com/jkmssoft/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jkmssoft\counter;

/**
 * This is the main module class for the Yii2-counter.
 *
 * @property string[] $modelMap
 *
 * @author jkmssoft
 */
class Module extends \yii\base\Module
{
    const VERSION = '0.1.0';

    // add here const and public settings-attributes

    /**
     * @var string The prefix for counter module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'counter';

    /** @var string[] Array (map) of the models. */
    public $modelMap = [];

    /** @var string[] The rules to be used in URL management. */
    public $urlRules = [
        'counters/<page:\d+>' => 'counter/index',
        'counters' => 'counter/index',
        'counter/<id:\d+>' => 'counter/view',
    ];
}
