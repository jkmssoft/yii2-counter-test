<?php

/*
 * This file is part of the yii2-counter project.
 *
 * (c) jkmssoft <http://github.com/jkmssoft/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use jkmssoft\counter\migrations\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `counter`.
 * @author jkmssoft
 *
 * docs: http://www.yiiframework.com/doc-2.0/guide-db-migrations.html
 */
class m160511_000000_init extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
/*
CREATE TABLE IF NOT EXISTS counter (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) UNIQUE NOT NULL,
counter BIGINT DEFAULT 0 NOT NULL,
visible SMALLINT(1) DEFAULT 0 NOT NULL,
created_at INT NOT NULL,
updated_at INT NOT NULL);
*/
        $this->createTable('{{%counter}}', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string(255)       ->notNull(),
            'counter'       => $this->bigInteger()      ->notNull() ->defaultValue(0),
            'visible'       => $this->smallInteger(1)   ->notNull() ->defaultValue(0),
            'created_at'    => $this->integer()         ->notNull(),
            'updated_at'    => $this->integer()         ->notNull(),
        ], $this->tableOptions);

        // unique name
        $this->createIndex('idx-counter-name', '{{%counter}}', 'name', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex(
            'idx-counter-name',
            '{{%counter}}'
        );

        $this->dropTable('{{%counter}}');
    }
}
