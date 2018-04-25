<?php
    namespace Enobrev\ORM\Field;


    use Enobrev\ORM\Escape;
    use Enobrev\ORM\Field;
    use Enobrev\ORM\FieldInvalidValueException;
    use Enobrev\ORM\Table;

    class Enum extends Field {
        /** @var array  */
        public $aValues = [];

        /**
         * @param string $sTable
         * @param string $sColumn
         * @param array $aValues
         */
        public function __construct($sTable, $sColumn, Array $aValues = array()) {
            $this->sColumn = '';

            if (is_array($sColumn)) {
                $aValues = $sColumn;
                $sColumn = $sTable;
                $sTable  = null;

                parent::__construct($sColumn);
            } else {
                parent::__construct($sTable, $sColumn);
            }
            
            if (count($aValues)) {
                $this->aValues = $aValues;
            }
        }
        
        /**
         *
         * @return string|integer
         */
        public function __toString() {
            if ($this->sValue) {
                return $this->sValue;
            }
            
            return '';
        }
        
        /**
         *
         * @return string
         */
        public function toSQL(): string {
            return Escape::string($this->__toString());
        }
        /**
         *
         * @return string
         */
        public function toSQLLog(): string {
            return parent::toSQLLog() . ':' . $this->__toString();
        }

        /**
         *
         * @return array
         */
        public function toInfoArray(): array {
            $aInfo = parent::toInfoArray();
            $aInfo['values'] = $this->aValues;

            return $aInfo;
        }

        /**
         * @return bool
         */
        public function hasValue(): bool {
            return parent::hasValue() && strlen((string) $this) > 0;
        }

        /**
         * @param string $sValue
         * @return bool
         */
        public function isValue($sValue):bool {
            return in_array($sValue, $this->aValues);
        }

        /**
         * @param mixed $sValue
         * @return $this
         * @throws FieldInvalidValueException
         */
        public function setValue($sValue) {
            if ($sValue instanceof Table) {
                $sValue = $sValue->{$this->sColumn};
            }

            if ($sValue instanceof Field) {
                $sValue = $sValue->getValue();
            }

            $sValue = (string) $sValue;
                        
            if (!$this->isValue($sValue)) {
                throw new FieldInvalidValueException($this->sColumn . ' [' . $sValue . ']');
            }

            $this->sValue = $sValue;

            return $this;
        }
    }