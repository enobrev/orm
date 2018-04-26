<?php
    namespace Enobrev;

    require __DIR__ . '/../../vendor/autoload.php';


    use Enobrev\ORM\Field;


    use Enobrev\ORM\Table;
    use PHPUnit\Framework\TestCase;
 
    class MySQLStringTrimmedTest extends TestCase {
        public function setUp() {
        }
        
        public function testLefTOuterJoin() {
            $oUsers = new Table('tags');
            $oUsers->addFields(
                new Field\Id('tag_id'),
                new Field\TextTrimmed('tag_title'),
                new Field\Boolean('tag_indexed')
            );

            $oUsers->tag_title->setValue(' I am trimmed ');

            $this->assertEquals($oUsers->tag_title->getValue(), 'I am trimmed');
        }
    }