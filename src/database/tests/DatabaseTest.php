<?php
declare(strict_types=1);

namespace UtilitiesTests\Database;

use PHPUnit\Framework\TestCase;
use Utilities\Database\SQLQueryBuilder;

class DatabaseTest extends TestCase
{

    public function test_create_update_query()
    {
        $this->assertEquals(
            $this->create_update_query(),
            "UPDATE `users` SET `name` = 'John Doe' WHERE `id` = 1"
        );
    }

    private function create_update_query(): string
    {
        return SQLQueryBuilder::update([
            'table' => 'users',
            'where' => [
                'id' => 1
            ],
            'columns' => [
                'name' => 'John Doe'
            ]
        ]);
    }

    public function test_create_insert_query()
    {
        $this->assertEquals(
            $this->create_insert_query(),
            "INSERT INTO `users` (`name`, `email`) VALUES ('John', 'john@example.com')"
        );
    }

    private function create_insert_query(): string
    {
        return SQLQueryBuilder::insert([
            'table' => 'users',
            'columns' => [
                'name' => 'John',
                'email' => 'john@example.com'
            ]
        ]);
    }

    public function test_create_delete_query()
    {
        $this->assertEquals(
            $this->create_delete_query(),
            "DELETE FROM `users` WHERE `id` = 1"
        );
    }

    private function create_delete_query(): string
    {
        return SQLQueryBuilder::delete([
            'table' => 'users',
            'where' => [
                'id' => 1
            ]
        ]);
    }

    public function test_create_select_query()
    {
        $this->assertEquals(
            $this->create_select_query(),
            "SELECT `id`, `name`, `email` FROM `users` WHERE `id` = 1"
        );
    }

    private function create_select_query(): string
    {
        return SQLQueryBuilder::select([
            'table' => 'users',
            'columns' => [
                'id',
                'name',
                'email'
            ],
            'where' => [
                'id' => 1
            ]
        ]);
    }

    public function test_create_select_query_with_multiple_where_conditions()
    {
        $this->assertEquals(
            SQLQueryBuilder::select([
                'table' => 'users',
                'columns' => [
                    'id',
                    'name',
                    'email'
                ],
                'where' => [
                    'id' => 1,
                    'name' => 'John'
                ]
            ]),
            "SELECT `id`, `name`, `email` FROM `users` WHERE `id` = 1 AND `name` = 'John'"
        );
    }

}