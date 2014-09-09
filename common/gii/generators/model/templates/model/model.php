<?php
/**
 * This is the template for generating the model class of a specified table.
 *
 * @var yii\web\View $this
 * @var yii\gii\generators\model\Generator $generator
 * @var string $tableName full table name
 * @var string $className class name
 * @var yii\db\TableSchema $tableSchema
 * @var string[] $labels list of attribute labels (name => label)
 * @var string[] $rules list of validation rules
 * @var array $relations list of relations (name => relation declaration)
 */

echo "<?php\n";
$ns = explode('\\', $generator->ns);
$ns[count($ns) - 1] = 'base' . $ns[count($ns) - 1];
$ns = implode('\\', $ns);
$tableName = substr($tableName, strlen(Yii::$app->db->tablePrefix));
?>

namespace <?= $generator->ns ?>;

/**
 * This is the model class for table "<?= $tableName ?>".
 * extends the base model.
 */
class <?= $className ?> extends <?= '\\' . $ns . '\\' . $className . "\n" ?>
{

}
