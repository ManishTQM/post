<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersPostTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersPostTable Test Case
 */
class UsersPostTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersPostTable
     */
    protected $UsersPost;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.UsersPost',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UsersPost') ? [] : ['className' => UsersPostTable::class];
        $this->UsersPost = $this->getTableLocator()->get('UsersPost', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UsersPost);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UsersPostTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
