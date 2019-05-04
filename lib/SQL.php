<?php
    namespace Enobrev;

    use Exception;
    use stdClass;

    class SQLException extends Exception {}
    class SQLMissingTableOrFieldsException extends SQLException {}
    class SQLMissingConditionException extends SQLException {}
    class SQLPrimaryValuesNotSetException extends SQLException {}

    class SQL {
        protected const TYPE_SELECT = 'SELECT';
        protected const TYPE_INSERT = 'INSERT';
        protected const TYPE_UPDATE = 'UPDATE';
        protected const TYPE_DELETE = 'DELETE';

        /** @var string  */
        public $sSQL;

        /** @var string  */
        public $sSQLGroup;

        /** @var string  */
        public $sSQLTable;

        /** @var string  */
        public $sSQLType;

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Conditions
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         * @throws ORM\ConditionsNonConditionException
         */
        public static function either(...$aArguments): ORM\Conditions {
            return ORM\Conditions::either(...$aArguments);
        }

        /**
         * @return string
         */
        public static function NOW(): string {
            return ORM\DateFunction::FUNC_NOW;
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Conditions
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         * @throws ORM\ConditionsNonConditionException
         */
        public static function also(...$aArguments): ORM\Conditions {
            return ORM\Conditions::also(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function eq(...$aArguments): ORM\Condition {
            return ORM\Condition::eq(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function neq(...$aArguments): ORM\Condition {
            return ORM\Condition::neq(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function lt(...$aArguments): ORM\Condition {
            return ORM\Condition::lt(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function gt(...$aArguments): ORM\Condition {
            return ORM\Condition::gt(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function lte(...$aArguments): ORM\Condition {
            return ORM\Condition::lte(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function gte(...$aArguments): ORM\Condition {
            return ORM\Condition::gte(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function like(...$aArguments): ORM\Condition {
            return ORM\Condition::like(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function nlike(...$aArguments): ORM\Condition {
            return ORM\Condition::nlike(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function nul(...$aArguments): ORM\Condition {
            return ORM\Condition::nul(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function nnul(...$aArguments): ORM\Condition {
            return ORM\Condition::nnul(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function in(...$aArguments): ORM\Condition {
            return ORM\Condition::in(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function nin(...$aArguments): ORM\Condition {
            return ORM\Condition::nin(...$aArguments);
        }

        /**
         * @param array ...$aArguments
         *
         * @return ORM\Condition
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         */
        public static function between(...$aArguments): ORM\Condition {
            return ORM\Condition::between(...$aArguments);
        }

        /**
         * @param ORM\Field                         $oFrom
         * @param ORM\Field                         $oTo
         * @param ORM\Condition|ORM\Conditions|null $oConditions
         *
         * @return ORM\Join
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         * @throws ORM\ConditionsNonConditionException
         */
        public static function join(ORM\Field $oFrom, ORM\Field $oTo, $oConditions = null): ORM\Join {
            return ORM\Join::create($oFrom, $oTo, $oConditions);
        }

        /**
         * @param int|null $iStart
         * @param int|null $iOffset
         * @return ORM\Limit
         */
        public static function limit($iStart = null, $iOffset = null): ORM\Limit {
            return ORM\Limit::create($iStart, $iOffset);
        }

        /**
         * @param ORM\Field[]  ...$aFields
         * @return ORM\Group
         */
        public static function group(...$aFields): ORM\Group {
            return ORM\Group::create(...$aFields);
        }

        /**
         * @param ORM\Field $oField
         * @param array $aValues
         * @return ORM\Order
         */
        public static function desc(ORM\Field $oField, Array $aValues = array()): ORM\Order {
            return ORM\Order::desc($oField, $aValues);
        }

        /**
         * @param ORM\Field $oField
         * @param array $aValues
         * @return ORM\Order
         */
        public static function asc(ORM\Field $oField, Array $aValues = array()): ORM\Order {
            return ORM\Order::asc($oField, $aValues);
        }

        /**
         * @param ORM\Field $oField
         * @param array $aValues
         * @return ORM\Order
         */
        public static function byfield(ORM\Field $oField, Array $aValues = array()): ORM\Order {
            return ORM\Order::byfield($oField, $aValues);
        }

        /**
         * @param array ...$aArguments
         *
         * @return SQL
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         * @throws ORM\ConditionsNonConditionException
         * @throws SQLMissingTableOrFieldsException
         * @deprecated Use SQLBuilder::select instead
         */
        public static function select(...$aArguments): SQL {
            $bStar       = false;

            /** @var ORM\Field[] $aFields */
            $aFields     = array();

            /** @var ORM\Table[] $aTables */
            $aTables     = array();

            /** @var ORM\Join[] $aJoins */
            $aJoins      = array();

            /** @var ORM\Order[] $aOrders */
            $aOrders     = array();

            /** @var ORM\Group $oGroup */
            $oGroup      = NULL;

            /** @var ORM\Limit $oLimit */
            $oLimit      = NULL;

            /** @var ORM\Conditions $oConditions */
            $oConditions = new ORM\Conditions;

            foreach($aArguments as $mArgument) {
                switch(true) {
                    case $mArgument instanceof ORM\Join:
                        $aJoins[] = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Joins:
                        foreach($mArgument as $oJoin) {
                            $aJoins[] = $oJoin;
                        }
                        break;

                    case $mArgument instanceof ORM\Order:
                        $aOrders[] = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Group:
                        $oGroup = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Limit:
                        $oLimit = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Table:
                        $aTables[] = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Conditions:
                    case $mArgument instanceof ORM\Condition:
                        $oConditions->add($mArgument);
                        break;

                    case $mArgument instanceof ORM\Field:
                        $aFields[] = $mArgument;
                        break;

                    case is_array($mArgument):
                        foreach($mArgument as $oField) {
                            if ($oField instanceof ORM\Field) {
                                $aFields[] = $mArgument;
                            }
                        }
                        break;
                }
            }

            if (count($aFields)) {
                /** @var ORM\Field $oField */
                foreach($aFields as $oField) {
                    $aTables[] = $oField->getTable();
                }
            } else if (count($aTables)) {
                $bStar  = true;
            }

            if (count($aTables) === 0) {
                throw new SQLMissingTableOrFieldsException;
            }

            /** @var ORM\Table $oFromTable */
            $oFromTable = $aTables[0];

            $aSQL = array(self::TYPE_SELECT);
            if ($bStar) {
                $aSQLFields = array('*');

                // Add hex'd aliases
                foreach($oFromTable->getFields() as $oField) {
                    if ($oField instanceof ORM\Field\Hash
                    ||  $oField instanceof ORM\Field\UUID) {
                        $aSQLFields[] = $oField->toSQLColumnForSelect();
                    }
                }

                $aSQL[] = implode(', ', $aSQLFields);
            } else {
                /** @var ORM\Field[] $aFields */
                $aSQL[] = self::toSQLColumnsForSelect($aFields);
            }

            $aSQL[] = 'FROM';
            $aSQL[] = $oFromTable->getTitle();

            if (count($aJoins)) {
                foreach($aJoins as $oJoin) {
                    $aSQL[] = $oJoin->toSQL();
                }
            }

            $aSQLLog = $aSQL;
            if ($oConditions->count()) {
                $aSQL[] = 'WHERE';
                $aSQL[] = $oConditions->toSQL();

                $aSQLLog[] = 'WHERE';
                $aSQLLog[] = $oConditions->toSQLLog();
            }

            if ($oGroup) {
                $aSQL[] = 'GROUP BY';
                $aSQL[] = $oGroup->toSQL();

                $aSQLLog[] = 'GROUP BY';
                $aSQLLog[] = $oGroup->toSQL();
            }

            if (count($aOrders)) {
                $aOrderSQL = array();
                foreach($aOrders as $oOrder) {
                    $aOrderSQL[] = $oOrder->toSQL();
                }

                $aSQL[] = 'ORDER BY';
                $aSQL[] = implode(', ', $aOrderSQL);

                $aSQLLog[] = 'ORDER BY';
                $aSQLLog[] = implode(', ', $aOrderSQL);
            }

            if ($oLimit instanceof ORM\Limit) {
                $aSQL[] = $oLimit->toSQL();

                $aSQLLog[] = $oLimit->toSQL();
            }

            $oSQL = new self;
            $oSQL->sSQLType  = self::TYPE_SELECT;
            $oSQL->sSQLTable = (string) $oFromTable->getTitle();
            $oSQL->sSQL      = implode(' ', $aSQL);
            $oSQL->sSQLGroup = implode(' ', $aSQLLog);

            return $oSQL;
        }

        /**
         * @param array ...$aArguments
         *
         * @return SQL
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         * @throws ORM\ConditionsNonConditionException
         * @deprecated Use SQLBuilder::count instead
         */
        public static function count(...$aArguments): SQL {
            /** @var ORM\Table[] $aTables */
            $aTables     = array();

            /** @var ORM\Join[] $aJoins */
            $aJoins      = array();

            /** @var ORM\Group $oGroup */
            $oGroup      = NULL;

            /** @var ORM\Conditions $oConditions */
            $oConditions = new ORM\Conditions;

            foreach($aArguments as $mArgument) {
                switch(true) {
                    case $mArgument instanceof ORM\Join:
                        $aJoins[] = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Joins:
                        foreach($mArgument as $oJoin) {
                            $aJoins[] = $oJoin;
                        }
                        break;

                    case $mArgument instanceof ORM\Group:
                        $oGroup = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Table:
                        $aTables[] = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Conditions:
                    case $mArgument instanceof ORM\Condition:
                        $oConditions->add($mArgument);
                        break;
                }
            }

            $oTable = $aTables[0];
            $aSQL   = array(self::TYPE_SELECT);

            $aPrimary = $oTable->getPrimary();

            if (count($aPrimary) === 1) {
                $aSQL[] = 'COUNT(' . self::toSQLColumnsForCount($aPrimary) . ') AS row_count';
            } else {
                $aSQL[] = 'COUNT(*) AS row_count';
            }

            $aSQL[] = 'FROM';
            $aSQL[] = $oTable->getTitle();

            /** @var ORM\Join[] $aJoins */
            if (count($aJoins)) {
                foreach($aJoins as $oJoin) {
                    $aSQL[] = $oJoin->toSQL();
                }
            }

            $aSQLLog = $aSQL;
            if ($oConditions->count()) {
                $aSQL[] = 'WHERE';
                $aSQL[] = $oConditions->toSQL();

                $aSQLLog[] = 'WHERE';
                $aSQLLog[] = $oConditions->toSQLLog();
            }

            if ($oGroup instanceof ORM\Group) {
                $aSQL[] = 'GROUP BY';
                $aSQL[] = $oGroup->toSQL();

                $aSQLLog[] = 'GROUP BY';
                $aSQLLog[] = $oGroup->toSQL();
            }

            $oSQL = new self;
            $oSQL->sSQLType  = self::TYPE_SELECT;
            $oSQL->sSQLTable = (string) $oTable->getTitle();
            $oSQL->sSQL      = implode(' ', $aSQL);
            $oSQL->sSQLGroup = implode(' ', $aSQLLog);

            return $oSQL;
        }

        /**
         * @param array ...$aArguments
         * @return SQL
         * @throws SQLMissingTableOrFieldsException
         * @deprecated Use SQLBuilder::insert instead
         */
        public static function insert(...$aArguments): SQL {
            $aFields     = [];
            $sTable      = NULL;

            foreach($aArguments as $mArgument) {
                switch(true) {
                    case $mArgument instanceof ORM\Field:
                        $aFields[] = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Table:
                        $sTable  = $mArgument->getTitle();
                        $aFields = array_merge($aFields, $mArgument->getFields());
                        break;
                }
            }

            if (count($aFields) === 0) {
                throw new SQLMissingTableOrFieldsException;
            }

            if ($sTable === NULL) {
                $sTable = $aFields[0]->sTable;
            }

            $oSQL = new self;
            $oSQL->sSQLType  = self::TYPE_INSERT;
            $oSQL->sSQLTable = (string) $sTable;
            $oSQL->sSQL      = implode(' ',
                array(
                    self::TYPE_INSERT . ' INTO',
                        $sTable,
                    '(',
                        self::toSQLColumnsForInsert($aFields),
                    ') VALUES (',
                        self::toSQL($aFields),
                    ')'
                )
            );

            $oSQL->sSQLGroup = implode(' ',
                array(
                    self::TYPE_INSERT . ' INTO',
                        $sTable,
                    '(',
                        self::toSQLColumnsForInsert($aFields),
                    ') VALUES (',
                        self::toSQLLog($aFields),
                    ')'
                )
            );

            return $oSQL;
        }

        /**
         * @param array ...$aArguments
         *
         * @return SQL
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         * @throws ORM\ConditionsNonConditionException
         * @throws SQLMissingConditionException
         * @throws SQLMissingTableOrFieldsException
         * @deprecated Use SQLBuilder::update instead
         */
        public static function update(...$aArguments): SQL {
            $aFields     = [];
            $oTable      = NULL;
            $oConditions = new ORM\Conditions;
            foreach($aArguments as $mArgument) {
                switch(true) {
                    case $mArgument instanceof ORM\Field:
                        $aFields[] = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Table:
                        $oTable = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Conditions:
                    case $mArgument instanceof ORM\Condition:
                        $oConditions->add($mArgument);
                        break;

                    case is_array($mArgument):
                        foreach($mArgument as $oField) {
                            if ($oField instanceof ORM\Field) {
                                $aFields[] = $mArgument;
                            }
                        }
                        break;
                }
            }

            if (count($aFields) === 0) {
                if ($oTable instanceof ORM\Table) {
                    $aFields = $oTable->getFields();
                } else {
                    throw new SQLMissingTableOrFieldsException;
                }
            }

            if ($oConditions->count() === 0) {
                throw new SQLMissingConditionException;
            }

            if ($oTable instanceof ORM\Table === false) {
                /** @var ORM\Field[] $aFields */
                $sTableObject = 'Table_' . (string) $aFields[0]->sTable;

                $oTable = new $sTableObject;
            }

            $oSQL = new self;
            $oSQL->sSQLType  = self::TYPE_UPDATE;
            $oSQL->sSQLTable = (string) $oTable->getTitle();
            /** @var ORM\Field[] $aFields */
            $oSQL->sSQL      = implode(' ',
                array(
                    self::TYPE_UPDATE,
                        $oTable->getTitle(),
                    'SET',
                        self::toSQLUpdate($aFields, $oTable->oResult),
                    'WHERE',
                        $oConditions->toSQL()
                )
            );

            $oSQL->sSQLGroup = implode(' ',
                array(
                    self::TYPE_UPDATE,
                        $oTable->getTitle(),
                    'SET',
                        self::toSQLUpdateLog($aFields, $oTable->oResult),
                    'WHERE',
                        $oConditions->toSQLLog()
                )
            );

            return $oSQL;
        }

        /**
         * @param array $aArguments
         *
         * @return SQL
         * @throws SQLMissingTableOrFieldsException
         * @throws SQLPrimaryValuesNotSetException
         * @deprecated Use SQLBuilder::upsert instead
         */
        public static function upsert(...$aArguments): SQL {
            $aFields     = [];
            $sTable      = null;
            $oTable      = null;
            foreach($aArguments as $mArgument) {
                switch(true) {
                    case $mArgument instanceof ORM\Field:
                        $aFields[] = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Table:
                        $oTable  = $mArgument;
                        $aFields = array_merge($aFields, $mArgument->getFields());
                        break;

                    case is_array($mArgument):
                        foreach($mArgument as $oField) {
                            if ($oField instanceof ORM\Field) {
                                $aFields[] = $mArgument;
                            }
                        }
                        break;
                }
            }

            if (count($aFields) === 0) {
                throw new SQLMissingTableOrFieldsException;
            }

            if ($oTable instanceof ORM\Table === false) {
                /** @var ORM\Field[] $aFields */
                $sTableObject = 'Table_' . (string) $aFields[0]->sTable;

                $oTable = new $sTableObject;
            }

            if (!$oTable->primaryHasValue()) {
                throw new SQLPrimaryValuesNotSetException;
            }

            $oSQL = new self;
            $oSQL->sSQLType  = 'UPSERT';
            $oSQL->sSQLTable = (string) $oTable->getTitle();
            /** @var ORM\Field[] $aFields */
            $oSQL->sSQL      = implode(' ',
                array(
                    'INSERT INTO',
                        $oTable->getTitle(),
                    '(',
                        self::toSQLColumnsForInsert($aFields),
                    ') VALUES (',
                        self::toSQL($aFields),
                    ') ON DUPLICATE KEY UPDATE',
                        self::toSQLUpdate($aFields)
                )
            );

            $oSQL->sSQLGroup = implode(' ',
                array(
                    'INSERT INTO',
                        $oTable->getTitle(),
                        '(',
                            self::toSQLColumnsForInsert($aFields),
                        ') VALUES (',
                            self::toSQLLog($aFields),
                        ')',
                    ') ON DUPLICATE KEY UPDATE',
                        self::toSQLLog($aFields)
                )
            );

            return $oSQL;
        }

        /**
         * @param array ...$aArguments
         *
         * @return SQL
         * @throws ORM\ConditionInvalidTypeException
         * @throws ORM\ConditionMissingBetweenValueException
         * @throws ORM\ConditionMissingFieldException
         * @throws ORM\ConditionMissingInValueException
         * @throws ORM\ConditionsNonConditionException
         * @throws SQLMissingTableOrFieldsException
         * @deprecated Use SQLBuilder::delete instead
         */
        public static function delete(...$aArguments): SQL {
            $aFields     = [];
            $sTable      = NULL;
            $oConditions = new ORM\Conditions;
            foreach($aArguments as $mArgument) {
                switch(true) {
                    case $mArgument instanceof ORM\Field:
                        $aFields[] = $mArgument;
                        break;

                    case $mArgument instanceof ORM\Table:
                        $sTable = $mArgument->getTitle();
                        $aFields = array_merge($aFields, $mArgument->getFields());
                        break;

                    case $mArgument instanceof ORM\Conditions:
                    case $mArgument instanceof ORM\Condition:
                        $oConditions->add($mArgument);
                        break;

                    case is_array($mArgument):
                        foreach($mArgument as $oField) {
                            if ($oField instanceof ORM\Field) {
                                $aFields[] = $mArgument;
                            }
                        }
                        break;
                }
            }

            if (count($aFields) === 0) {
                throw new SQLMissingTableOrFieldsException;
            }

            if ($oConditions->count() === 0) {
                /** @var ORM\Field[] $aFields */
                /** @psalm-suppress InvalidArgument */
                $oConditions->add($aFields);
            }

            if ($sTable === NULL) {
                /** @var ORM\Field[] $aFields */
                $sTable = (string) $aFields[0]->sTable;
            }

            $oSQL = new self;
            $oSQL->sSQLType  = self::TYPE_DELETE;
            $oSQL->sSQLTable = $sTable;
            $oSQL->sSQL      = implode(' ',
                array(
                    'DELETE FROM',
                        $sTable,
                    'WHERE',
                        $oConditions->toSQL()
                )
            );

            $oSQL->sSQLGroup = implode(' ',
                array(
                    'DELETE FROM',
                        $sTable,
                    'WHERE',
                        $oConditions->toSQLLog()
                )
            );

            return $oSQL;
        }

        /**
         * @param ORM\Field[] $aFields
         * @param bool $bWithTable
         * @return string
         */
        private static function toSQLColumnsForSelect($aFields, $bWithTable = true): string {
            $aColumns = array();

            /** @var ORM\Field $oField */
            foreach($aFields as $oField) {
                $aColumns[] = $oField->toSQLColumnForSelect($bWithTable);
            }

            return implode(', ', $aColumns);
        }

        /**
         * @param ORM\Field[] $aFields
         * @param bool $bWithTable
         * @return string
         */
        private static function toSQLColumnsForCount($aFields, $bWithTable = true): string {
            $aColumns = array();

            /** @var ORM\Field $oField */
            foreach($aFields as $oField) {
                $aColumns[] = $oField->toSQLColumnForCount($bWithTable);
            }

            return implode(', ', $aColumns);
        }

        /**
         * @param ORM\Field[] $aFields
         * @return string
         */
        private static function toSQLColumnsForInsert($aFields): string {
            $aColumns = array();

            /** @var ORM\Field $oField */
            foreach($aFields as $oField) {
                $aColumns[] = $oField->toSQLColumnForInsert();
            }

            return implode(', ', $aColumns);
        }

        /**
         * @param ORM\Field[] $aFields
         * @return string
         */
        private static function toSQL($aFields): string {
            $aColumns = array();

            /** @var ORM\Field $oField */
            foreach($aFields as $oField) {
                $aColumns[] = $oField->toSQL();
            }

            return implode(', ', $aColumns);
        }

        /**
         * @param ORM\Field[] $aFields
         * @return string
         */
        private static function toSQLLog($aFields): string {
            $aColumns = array();
            foreach($aFields as $oField) {
                $aColumns[] = get_class($oField);
            }

            return implode(', ', $aColumns);
        }

        /**
         * @param ORM\Field[] $aFields
         * @param stdClass|null $oResult
         * @return string
         */
        public static function toSQLUpdate(Array $aFields, stdClass $oResult = NULL): string {
            $aColumns = array();

            foreach($aFields as $oField) {
                if (($oResult !== null) &&
                    property_exists($oResult, $oField->sColumn) &&
                    $oField->is($oResult->{$oField->sColumn})) {
                        continue;
                    }

                $aColumns[] = $oField->toSQLColumn(false) . ' = ' . $oField->toSQL();
            }

            return implode(', ', $aColumns);
        }

        /**
         * @param ORM\Field[] array $aFields
         * @param stdClass|null $oResult
         * @return string
         */
        public static function toSQLUpdateLog(Array $aFields, stdClass $oResult = NULL): string {
            $aColumns = array();

            /** @var ORM\Field $oField */
            foreach($aFields as $oField) {
                if (($oResult !== null) &&
                    property_exists($oResult, $oField->sColumn) &&
                    $oField->is($oResult->{$oField->sColumn})) {
                        continue;
                    }

                /** @var ORM\Field $oField */
                $aColumns[] = $oField->toSQLColumn(false) . ' = ' . get_class($oField);
            }

            return implode(', ', $aColumns);
        }

        public function __toString() {
            return $this->sSQL;
        }
    }
