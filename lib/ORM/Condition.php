<?php
    namespace Enobrev\ORM;
    
    class ConditionException extends DbException {}
    class ConditionInvalidTypeException extends ConditionException {}
    class ConditionMissingBetweenValueException extends ConditionException {}
    class ConditionMissingInValueException extends ConditionException {}
    class ConditionMissingFieldException extends ConditionException {}

    class Condition {
        public const JOIN            = '_FIELD_TO_FIELD_';

        protected const FIELD_TO_FIELD = '_FIELD_TO_FIELD_';

        protected const LT           = '<';
        protected const LTE          = '<=';
        protected const GT           = '>';
        protected const GTE          = '>=';
        protected const EQUAL        = '=';
        protected const NEQ          = '<>';
        protected const IN           = 'IN';
        protected const NIN          = 'NOT IN';
        protected const LIKE         = 'LIKE';
        protected const NLIKE        = 'NOT LIKE';
        protected const ISNULL       = 'IS NULL';
        protected const NOTNULL      = 'IS NOT NULL';
        protected const BETWEEN      = 'BETWEEN';

        /** @var string  */
        protected $sSign;

        /** @var bool */
        protected $bFieldToField = false;

        /** @var array  */
        protected $aElements = [];

        /** @var array  */
        protected static $aSigns = [
            self::NOTNULL, self::LT, self::LTE, self::GT, self::GTE, self::EQUAL, self::NEQ, self::LIKE, self::NLIKE, self::ISNULL, self::BETWEEN, self::IN, self::NIN
        ];

        public function __clone() {
            foreach ($this->aElements as $iElement => $mElement) {
                if ($mElement instanceof Field) {
                    $this->aElements[$iElement] = clone $mElement;
                } else {
                    $this->aElements[$iElement] = $mElement;
                }
            }
        }

        /**
         * @param mixed $sElement
         * @return bool
         */
        protected static function isSign($sElement): bool {
            return in_array($sElement, self::$aSigns, true);
        }

        /**
         * @param string $sSign
         * @param  mixed ...$aElements,... As many args as necessary.  Field MUST come before values.  Condition Type can come in any order, defaults to Equals
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        protected static function create(string $sSign, ...$aElements): Condition {
            if (!self::isSign($sSign)) {
                throw new ConditionInvalidTypeException();
            }

            $oCondition = new self;
            $oCondition->sSign = $sSign;

            foreach($aElements as $mElement) {
                if ($mElement === self::FIELD_TO_FIELD) {
                    $oCondition->bFieldToField = true;
                } else if ($mElement instanceof Field) {
                    $oCondition->aElements[] = $mElement;
                } else if (isset($oCondition->aElements[0])
                       &&        $oCondition->aElements[0] instanceof Field) { // Value should be of the same field type as Field
                    /** @var Field $oField */
                    $oField = clone $oCondition->aElements[0];

                    if (is_array($mElement)) {
                        $oCondition->aElements[] = $mElement;
                    } else {
                        $oField->setValue($mElement);
                        $oCondition->aElements[] = $oField;
                    }
                } else {
                    $oCondition->aElements[] = $mElement;
                }
            }

            if ($oCondition->sSign === self::BETWEEN) {
                if (count($oCondition->aElements) < 2) {
                    throw new ConditionMissingBetweenValueException;
                }
            } else if ($oCondition->sSign === self::IN
                   ||  $oCondition->sSign === self::NIN) {

                if (count($oCondition->aElements) < 1) {
                    throw new ConditionMissingFieldException;
                }

                if (!is_array($oCondition->aElements[1])) {
                    throw new ConditionMissingInValueException;
                }
            } else if (count($oCondition->aElements) < 1) {
                throw new ConditionMissingFieldException;
            }

            return $oCondition;
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function eq(...$aArguments): Condition {
            return self::create(self::EQUAL, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function neq(...$aArguments): Condition {
            return self::create(self::NEQ, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function lt(...$aArguments): Condition {
            return self::create(self::LT, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function lte(...$aArguments): Condition {
            return self::create(self::LTE, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function gt(...$aArguments): Condition {
            return self::create(self::GT, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function gte(...$aArguments): Condition {
            return self::create(self::GTE, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function like(...$aArguments): Condition {
            return self::create(self::LIKE, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function nlike(...$aArguments): Condition {
            return self::create(self::NLIKE, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function in(...$aArguments): Condition {
            return self::create(self::IN, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function nin(...$aArguments): Condition {
            return self::create(self::NIN, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function nul(...$aArguments): Condition {
            return self::create(self::ISNULL, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function nnul(...$aArguments): Condition {
            return self::create(self::NOTNULL, ...$aArguments);
        }

        /**
         * @param mixed ...$aArguments
         *
         * @return Condition
         * @throws ConditionInvalidTypeException
         * @throws ConditionMissingBetweenValueException
         * @throws ConditionMissingFieldException
         * @throws ConditionMissingInValueException
         */
        public static function between(...$aArguments): Condition {
            return self::create(self::BETWEEN, ...$aArguments);
        }

        public function __construct() {
            $this->sSign     = self::EQUAL;
            $this->aElements = array();
        }

        /**
         * @return string
         */
        public function toSQL(): ?string {
            if (!count($this->aElements)) {
                return '';
            }

            /** @var Field $oField */
            $oField = $this->aElements[0];

            if ($this->bFieldToField) {
                /** @var Field $oField1 */
                $oField1 = $this->aElements[1];

                return implode(' ',
                    array(
                        $oField->toSQLColumn(),
                        $this->sSign,
                        $oField1->toSQLColumn()
                    )
                );
            }

            if (count($this->aElements) === 1) {
                if ($this->sSign === self::ISNULL
                ||  $this->sSign === self::NOTNULL) {
                    return implode(' ',
                        array(
                            $oField->toSQLColumn(),
                            $this->sSign
                        )
                    );
                }

                return implode(' ',
                    array(
                        $oField->toSQLColumn(),
                        $this->sSign,
                        $oField->toSQL()
                    )
                );
            }

            if ($this->sSign === self::BETWEEN) {
                /** @var Field $oField1 */
                $oField1 = $this->aElements[1];
                if (count($this->aElements) === 2) {
                    return implode(' ',
                        array(
                            $oField->toSQLColumn(),
                            $this->sSign,
                            $oField->toSQL(),
                            'AND',
                            $oField1->toSQL()
                        )
                    );
                }

                /** @var Field $oField2 */
                $oField2 = $this->aElements[2];
                return implode(' ',
                           array(
                        $oField->toSQLColumn(),
                        $this->sSign,
                        $oField1->toSQL(),
                        'AND',
                        $oField2->toSQL()
                    )
                );
            }

            if ($this->sSign === self::IN
            ||  $this->sSign === self::NIN) {
                // format values
                $aValues = $this->aElements[1];
                foreach ($aValues as &$sValue) {
                    $oField->setValue($sValue);
                    $sValue = $oField->toSQL();
                }

                return implode(' ',
                    array(
                        $oField->toSQLColumn(),
                        $this->sSign,
                        '(',
                        implode(', ', $aValues),
                        ')'
                    )
                );
            }

            /** @var Field $oField1 */
            $oField1 = $this->aElements[1];

            return implode(' ',
                       array(
                    $oField->toSQLColumn(),
                    $this->sSign,
                    $oField1->toSQL()
                )
            );
        }

        /**
         * @return string
         */
        public function toSQLLog(): string {
            /** @var Field $oField */
            $oField = $this->aElements[0];

            if ($this->bFieldToField) {
                /** @var Field $oField1 */
                $oField1 = $this->aElements[1];

                return implode(' ',
                    array(
                        $oField->toSQLColumn(),
                        $this->sSign,
                        $oField1->toSQLColumn()
                    )
                );
            }

            if (count($this->aElements) === 1) {
                if ($this->sSign === self::ISNULL) {
                    return implode(' ',
                        array(
                            $oField->toSQLColumn(),
                            $this->sSign
                        )
                    );
                }

                return implode(' ',
                    array(
                        $oField->toSQLColumn(),
                        $this->sSign,
                        $oField->toSQLLog()
                    )
                );
            }

            if ($this->sSign === self::BETWEEN) {
                /** @var Field $oField1 */
                $oField1 = $this->aElements[1];
                if (count($this->aElements) === 2) {
                    return implode(' ',
                        array(
                            $oField->toSQLColumn(),
                            $this->sSign,
                            $oField->toSQLLog(),
                            'AND',
                            $oField1->toSQLLog()
                        )
                    );
                }

                /** @var Field $oField2 */
                $oField2 = $this->aElements[2];
                return implode(' ',
                           array(
                        $oField->toSQLColumn(),
                        $this->sSign,
                        $oField1->toSQLLog(),
                        'AND',
                        $oField2->toSQLLog()
                    )
                );
            }

            if ($this->sSign === self::IN
            ||  $this->sSign === self::NIN) {
                // format values
                $aValues = $this->aElements[1];
                foreach ($aValues as &$sValue) {
                    $oField->setValue($sValue);
                    $sValue = $oField->toSQLLog();
                }

                return implode(' ',
                    array(
                        $oField->toSQLColumn(),
                        $this->sSign,
                        '(Array)'
                    )
                );
            }

            /** @var Field $oField1 */
            $oField1 = $this->aElements[1];

            return implode(' ',
                       array(
                    $oField->toSQLColumn(),
                    $this->sSign,
                    $oField1->toSQLLog()
                )
            );
        }

        public function toKey(): string {
            $sKey = str_replace(' ', '_', $this->toSQL());
            return preg_replace('/[^a-zA-Z0-9_=<>!]/', '-', $sKey);
        }
    }
