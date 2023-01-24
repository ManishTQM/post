<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersCommentTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersCommentTable Test Case
 */
class UsersCommentTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersCommentTable
     */
    protected $UsersComment;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.UsersComment',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UsersComment') ? [] : ['className' => UsersCommentTable::class];
        $this->UsersComment = $this->getTableLocator()->get('UsersComment', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UsersComment);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UsersCommentTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
