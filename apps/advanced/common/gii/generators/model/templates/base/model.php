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
$ns[count($ns) - 1] = substr($ns[count($ns) - 1], 4);
$ns = implode('\\', $ns);
$tableName = substr($tableName, strlen(Yii::$app->db->tablePrefix));
?>

namespace <?= $generator->ns ?>;

/**
 * This is the model class for table "<?= $tableName ?>".
 *
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $generator->ns ?>\<?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%<?= $tableName ?>}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [<?= "\n\t\t\t" . implode(",\n\t\t\t", $rules) . "\n\t\t" ?>];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
<?php foreach ($labels as $name => $label): ?>
			<?= "'$name' => '" . addslashes($label) . "',\n" ?>
<?php endforeach; ?>
		];
	}
<?php foreach ($relations as $name => $relation): ?>
<?php $relation[0] = str_replace('hasOne(', 'hasOne(' . '\\' . $ns . '\\', $relation[0]); ?>
<?php $relation[0] = str_replace('hasMany(', 'hasMany(' . '\\' . $ns . '\\', $relation[0]); ?>
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function get<?= $name ?>()
	{
		<?= $relation[0] . "\n" ?>
	}
<?php endforeach; ?>
}
