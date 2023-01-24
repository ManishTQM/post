<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersComment Model
 *
 * @method \App\Model\Entity\UsersComment newEmptyEntity()
 * @method \App\Model\Entity\UsersComment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UsersComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersComment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UsersComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersComment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersComment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersComment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersComment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersComment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersComment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersComment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersCommentTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users_comment');
        $this->setDisplayField('comment');
        $this->setPrimaryKey('id');

        $this->belongsTo('UsersPost',[
            'foreignkey'=>'post_id',
            'joinType'=>'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('comment')
            ->maxLength('comment', 200)
            ->allowEmptyString('comment');

        return $validator;
    }
}
