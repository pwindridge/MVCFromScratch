<?php


use \Core\{
    App, Database\Connection
};
use \PHPUnit\Framework\TestCase;


require '../core/bootstrap.php';


class QueryBuilderTest extends TestCase {

    public function setUp(): void
    {
        $pdo = Connection::make(App::get('config')['database']);

        $pdo->query("DROP TABLE IF EXISTS `test_table`");

        $pdo->query("CREATE TABLE `test_table` ( " .
            "`field1` varchar(9) NOT NULL DEFAULT '', " .
            "`field2` varchar(50) NOT NULL DEFAULT '', " .
            "PRIMARY KEY (`field1`)" .
            ") ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $pdo->query("INSERT INTO `test_table` (`field1`, `field2`) " .
            "VALUES " .
            "('rec1val1', 'rec1val2'), " .
            "('rec2val1','rec2val2') ," .
            "('rec3val1','rec3val2'), " .
            "('rec4val1','rec4val2');"
        );
    }

    public function tearDown(): void
    {
        $pdo = Connection::make(App::get('config')['database']);

        $pdo->query("DROP TABLE `test_table`");
    }

    public function testSelectAll()
    {
        $expected = [
            (object)[
                'field1' => 'rec1val1',
                'field2' => 'rec1val2'
            ],
            (object)[
                'field1' => 'rec2val1',
                'field2' => 'rec2val2'
            ],
            (object)[
                'field1' => 'rec3val1',
                'field2' => 'rec3val2'
            ],
            (object)[
                'field1' => 'rec4val1',
                'field2' => 'rec4val2'
            ]
        ];

        $actual = App::get('database')->selectAll('test_table');

        $this->assertEquals($expected, $actual);
    }

    public function testSelectOneFieldAllRecords()
    {
        $actual = App::get('database')->select('test_table', ['field2'])
            ->execute()
            ->fetchAll();

        $expected = [
            (object)[
                'field2' => 'rec1val2'
            ],
            (object)[
                'field2' => 'rec2val2'
            ],
            (object)[
                'field2' => 'rec3val2'
            ],
            (object)[
                'field2' => 'rec4val2'
            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSelectTwoFieldsAllRecords()
    {
        $actual = App::get('database')->select('test_table', ['field1', 'field2'])
            ->execute()
            ->fetchAll();

        $expected = [
            (object)[
                'field1' => 'rec1val1',
                'field2' => 'rec1val2'
            ],
            (object)[
                'field1' => 'rec2val1',
                'field2' => 'rec2val2'
            ],
            (object)[
                'field1' => 'rec3val1',
                'field2' => 'rec3val2'
            ],
            (object)[
                'field1' => 'rec4val1',
                'field2' => 'rec4val2'
            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSelectOneFieldWhere()
    {
        $actual = App::get('database')->select('test_table', ['field2'])
            ->where('field1', '=', 'rec3val1')
            ->execute()
            ->fetchAll();

        $expected = [(object)['field2' => 'rec3val2']];

        $this->assertEquals($expected, $actual);
    }

    public function testSelectOneFieldWhereAnd()
    {
        $actual = App::get('database')->select('test_table', ['field2'])
            ->where('field1', '=', 'rec3val1')
            ->and('field2', '=', 'rec3val2')
            ->execute()
            ->fetchAll();

        $expected = [(object)['field2' => 'rec3val2']];

        $this->assertEquals($expected, $actual);
    }

    public function testSelectOneFieldWhereOr()
    {
        $actual = App::get('database')->select('test_table', ['field2'])
            ->where('field1', '=', 'rec3val1')
            ->or('field1', '=', 'rec4val1')
            ->execute()
            ->fetchAll();

        $expected = [
            (object)[
                'field2' => 'rec3val2'
            ],
            (object)[
                'field2' => 'rec4val2'
            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testInsert()
    {
        $actualRowCount = App::get('database')->insert('test_table', [
                'field1' => 'testval1',
                'field2' => 'testval2'
            ]
        );

        $actual = App::get('database')->selectAll('test_table');

        $expected = [
            (object)[
                'field1' => 'rec1val1',
                'field2' => 'rec1val2'
            ],
            (object)[
                'field1' => 'rec2val1',
                'field2' => 'rec2val2'
            ],
            (object)[
                'field1' => 'rec3val1',
                'field2' => 'rec3val2'
            ],
            (object)[
                'field1' => 'rec4val1',
                'field2' => 'rec4val2'
            ],
            (object)[
                'field1' => 'testval1',
                'field2' => 'testval2'
            ]
        ];

        $this->assertEquals($expected, $actual);
        $this->assertEquals(1, $actualRowCount);
    }

    public function testUpdateAllRecordsOneField()
    {
        App::get('database')->update('test_table', [
                'field2' => 'updated'
            ]
        )->execute();

        $actual = App::get('database')->select('test_table', ['field2'])
            ->execute()
            ->fetchAll();

        $expected = [
            (object)[
                'field2' => 'updated'
            ],
            (object)[
                'field2' => 'updated'
            ],
            (object)[
                'field2' => 'updated'
            ],
            (object)[
                'field2' => 'updated'
            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testUpdateOneRecordOneField()
    {
        App::get('database')->update('test_table', [
                'field2' => 'updated'
            ])
            ->where('field1', '=', 'rec3val1')
            ->execute();

        $actual = App::get('database')->select('test_table', ['field2'])
            ->execute()
            ->fetchAll();

        $expected = [
            (object)[
                'field2' => 'rec1val2'
            ],
            (object)[
                'field2' => 'rec2val2'
            ],
            (object)[
                'field2' => 'updated'
            ],
            (object)[
                'field2' => 'rec4val2'
            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testUpdateOneRecordTwoFields()
    {
        App::get('database')->update('test_table', [
            'field1' => 'updated',
            'field2' => 'updated'
        ])
            ->where('field1', '=', 'rec3val1')
            ->execute();

        $actual = App::get('database')->selectAll('test_table');

        $expected = [
            (object)[
                'field1' => 'rec1val1',
                'field2' => 'rec1val2'
            ],
            (object)[
                'field1' => 'rec2val1',
                'field2' => 'rec2val2'
            ],
            (object)[
                'field1' => 'rec4val1',
                'field2' => 'rec4val2'
            ],
            (object)[
                'field1' => 'updated',
                'field2' => 'updated'
            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testDeleteAllRecords()
    {
        $actual = App::get('database')->delete('test_table')->execute()->rowsAffected();

        $this->assertEquals(4, $actual);
    }

    public function testDeleteOneRecord()
    {
        App::get('database')->delete('test_table')
            ->where('field1', '=', 'rec3val1')
            ->execute();

        $actual = App::get('database')->selectAll('test_table');

        $expected = [
            (object)[
                'field1' => 'rec1val1',
                'field2' => 'rec1val2'
            ],
            (object)[
                'field1' => 'rec2val1',
                'field2' => 'rec2val2'
            ],
            (object)[
                'field1' => 'rec4val1',
                'field2' => 'rec4val2'
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}
