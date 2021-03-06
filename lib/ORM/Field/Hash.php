<?php
    namespace Enobrev\ORM\Field;

    use Enobrev\ORM\Exceptions\DbException;

    class Hash extends Text {

        /**
         *
         * @param mixed $sValue
         * @return $this
         * @noinspection PhpMissingReturnTypeInspection
         */
        public function setValue($sValue) {
            parent::setValue($sValue);

            if (!$this->isNull() && preg_match('/[^\x20-\x7f]/', $this->sValue)) {
                $this->sValue = bin2hex($this->sValue);
            }

            return $this;
        }

        /**
         * @return string
         * @throws DbException
         */
        public function toSQL(): string {
            if ($this->isNull()) {
                return 'NULL';
            }

            return 'UNHEX(' . parent::toSQL() . ')';
        }

        public function toSQLColumnsForInsert(bool $bWithTable = true):string {
            if ($bWithTable) {
                $aTableColumn = array($this->sTable, $this->sColumn);
                $sTableColumn = 'LOWER(HEX(' . implode('.', $aTableColumn) . '))';

                return implode(' ', array($sTableColumn, 'AS', $this->sColumn));
            }

            return 'LOWER(HEX(' . $this->sColumn . '))';
        }

        public function toSQLColumnForSelect(bool $bWithTable = true, bool $bAnyValue = false):string {
            if ($bWithTable) {
                $aTableColumn = array($this->sTable, $this->sColumn);
                $sTableColumn = implode('.', $aTableColumn);
                $sTableColumn = 'LOWER(HEX(' . $sTableColumn . '))';

                if ($this->sAlias) {
                    $aAliasColumn = array($this->sAlias, $this->sColumn);
                    $sAliasColumn = implode('_', $aAliasColumn);

                    return implode(' ', array($sTableColumn, 'AS', $sAliasColumn));
                }

                if ($this->sTable) {
                    return implode(' ', array($sTableColumn, 'AS', $this->sColumn));
                }
            }

            return 'LOWER(HEX(' . $this->sColumn . '))';
        }

        /** @noinspection PhpMissingReturnTypeInspection */
        public function getValue() {
            if ($this->isNull()) {
                return null;
            }

            if(preg_match('/[^\x20-\x7f]/', $this->sValue)) {
                return bin2hex($this->sValue);
            }

            return parent::getValue();
        }
    }