<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersCommentFixture
 */
class UsersCommentFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'users_comment';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'uc_id' => 1,
                'comment' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
