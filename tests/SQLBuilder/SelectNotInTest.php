<?php
    namespace Enobrev;

    use Enobrev\ORM\Mock\User;

    class SQLBuilderSelectNotInTest extends \PHPUnit_Framework_TestCase {
        public function testSelectNoIntNotInValue() {
            $oUser = new User();
            $oSQL = SQLBuilder::select($oUser)->nin($oUser->user_id, [1, 2, 3, 4, 5]);
            $this->assertEquals("SELECT * FROM users WHERE users.user_id NOT IN ( 1, 2, 3, 4, 5 )", (string) $oSQL);
        }
    }