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

use Yii;
use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;

/**
 * Bootstrap class registers module and counter application component.
 *
 * @author jkmssoft
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @var string[] Array (map) of the models.
     */
    private $_asModelMap = [
        'Counter'       => 'jkmssoft\counter\models\Counter',
        'CounterSearch' => 'jkmssoft\counter\models\CounterSearch',
    ];

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app->hasModule('counter') && ($module = $app->getModule('counter')) instanceof Module) {
            $this->_asModelMap = array_merge($this->_asModelMap, $module->modelMap);
            foreach ($this->_asModelMap as $name => $definition) {
                $class = "jkmssoft\\counter\\models\\".$name;
                Yii::$container->set($class, $definition);
                $modelName = is_array($definition) ? $definition['class'] : $definition;
                $module->modelMap[$name] = $modelName;
                if (in_array($name, ['Counter'])) {
                    Yii::$container->set($name.'Query', function () use ($modelName) {
                        return $modelName::find();
                    });
                }
            } // foreach

            $configUrlRule = [
                'prefix' => $module->urlPrefix,
                'rules'  => $module->urlRules,
            ];

            if ($module->urlPrefix != 'counter') {
                $configUrlRule['routePrefix'] = 'counter';
            }

            $configUrlRule['class'] = 'yii\web\GroupUrlRule';
            $rule = Yii::createObject($configUrlRule);

            $app->urlManager->addRules([$rule], false);

            if (!isset($app->get('i18n')->translations['counter*'])) {
                $app->get('i18n')->translations['counter*'] = [
                    'class'             => PhpMessageSource::className(),
                    'basePath'          => __DIR__.'/messages',
                    'sourceLanguage'    => 'en-US'
                ];
            } // if
        } // if module
    } // bootstrap
}
