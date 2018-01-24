<?php
    namespace Enobrev\ORM;
    
    class JoinException extends DbException {}

    class Join {
        const LEFT_OUTER = 'LEFT OUTER';

        /** @var string  */
        private $sType;
        
        /** @var  Field */
        private $oFrom = null;

        /** @var  Field */
        private $oTo = null;

        /**
         * @param Field $oFrom
         * @param Field $oTo
         * @return Join
         */
        public static function create($oFrom, $oTo) {            
            $oJoin = new self;
            $oJoin->oFrom = $oFrom;
            $oJoin->oTo   = $oTo;
            return $oJoin;
        }

        public function __construct() {
            $this->sType   = self::LEFT_OUTER;
        }

        public function toSQL(): string {
            if ($this->oTo->hasAlias()) {
                return implode(' ',
                    array(
                        $this->sType,
                        'JOIN',
                        $this->oTo->sTable,
                        'AS',
                        $this->oTo->sAlias,
                        'ON',
                        $this->oFrom->toSQLColumn(),
                        '=',
                        $this->oTo->toSQLColumn()
                    )
                );
            } else {
                return implode(' ',
                    array(
                        $this->sType,
                        'JOIN',
                        $this->oTo->sTable,
                        'ON',
                        $this->oFrom->toSQLColumn(),
                        '=',
                        $this->oTo->toSQLColumn()
                    )
                );
            }
        }
    }
