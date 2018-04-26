<?php
    namespace Enobrev;

    require __DIR__ . '/../../vendor/autoload.php';

    use Enobrev\ORM\Mock\Table\User;
    use PHPUnit\Framework\TestCase;

    class SelectAlsoTest extends TestCase {
        public function testSelectAlsoFlat() {
            $oUser = new User();
            $oSQL = SQL::select(
                $oUser,
                SQL::eq($oUser->user_id, 1),
                SQL::eq($oUser->user_email, 'test@example.com')
            );
            $this->assertEquals('SELECT * FROM users WHERE users.user_id = 1 AND users.user_email = "test@example.com"', (string) $oSQL);
        }

        public function testSelectAlsoBookended() {
            $oUser = new User();
            $oSQL = SQL::select(
                $oUser,
                SQL::also(
                    SQL::eq($oUser->user_id, 1),
                    SQL::eq($oUser->user_email, 'test@example.com')
                )
            );
            $this->assertEquals('SELECT * FROM users WHERE users.user_id = 1 AND users.user_email = "test@example.com"', (string) $oSQL);
        }

        public function testSelectAlsoNested() {
            $oUser = new User();
            $oSQL = SQL::select(
                $oUser,
                SQL::also(
                    SQL::also(
                        SQL::eq($oUser->user_id, 1),
                        SQL::eq($oUser->user_email, 'test@example.com')
                    )
                )
            );
            $this->assertEquals('SELECT * FROM users WHERE users.user_id = 1 AND users.user_email = "test@example.com"', (string) $oSQL);
        }

        public function testSelectAlsoGrouped() {
            $oUser = new User();
            $oSQL = SQL::select(
                $oUser,
                SQL::also(
                    SQL::also(
                        SQL::eq($oUser->user_id, 1),
                        SQL::eq($oUser->user_email, 'test@example.com')
                    ),
                    SQL::also(
                        SQL::eq($oUser->user_id, 1),
                        SQL::eq($oUser->user_email, 'test@example.com')
                    )
                )
            );
            $this->assertEquals('SELECT * FROM users WHERE (users.user_id = 1 AND users.user_email = "test@example.com") AND (users.user_id = 1 AND users.user_email = "test@example.com")', (string) $oSQL);
        }
    }