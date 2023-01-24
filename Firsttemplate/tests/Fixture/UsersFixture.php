<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'phone_number' => 1,
                'password' => 'Lorem ipsum dolor sit amet',
                'gender' => 'Lorem i',
                'created_date' => '2023-01-18 09:50:24',
                'modified_date' => '2023-01-18 09:50:24',
                'code' => 'Lorem ipsum dolor sit amet',
                'updated_time' => '2023-01-18 09:50:24',
            ],
        ];
        parent::init();
    }
}
