<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersPost Model
 *
 * @method \App\Model\Entity\UsersPost newEmptyEntity()
 * @method \App\Model\Entity\UsersPost newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UsersPost[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersPost get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersPost findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UsersPost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersPost[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersPost|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersPost saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersPost[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersPost[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersPost[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UsersPost[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersPostTable extends Table
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

        $this->setTable('users_post');
        $this->setDisplayField('post_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users',[
            'foreignkey'=>'uc_id',
            'joinType'=>'INNER',
        ]);
        $this->hasMany('UsersComment',[
            'bindingKey' => 'id',
            'foreignKey' => 'post_id'
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
            ->scalar('post_name')
            ->maxLength('post_name', 200)
            ->allowEmptyString('post_name');

        $validator
            ->scalar('image')
            ->maxLength('image', 250)
            ->allowEmptyFile('image');

        return $validator;
    }
}
