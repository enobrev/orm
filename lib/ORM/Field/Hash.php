<?php
    namespace Enobrev\ORM\Field;

    class Hash extends Text {

        /**
         *
         * @param mixed $sValue
         */
        public function setValue($sValue) {
            parent::setValue($sValue);

            if (!$this->isNull()) {
                if(preg_match('/[^\x20-\x7f]/', $this->sValue)) {
                    $this->sValue = bin2hex($this->sValue);
                }
            }
        }

        /**
         *
         * @return string
         */
        public function toSQL() {
            if ($this->isNull()) {
                return 'NULL';
            } else {
                return 'UNHEX(' . parent::toSQL() . ')';
            }
        }

        /**
         * @param bool $bWithTable
         * @return string
         */
        public function toSQLColumnsForInsert($bWithTable = true) {
            if ($bWithTable) {
                $aTableColumn = array($this->sTable, $this->sColumn);
                $sTableColumn = "LOWER(HEX(" . implode('.', $aTableColumn) . "))";

                return implode(' ', array($sTableColumn, "AS", $this->sColumn));
            }

            return  "LOWER(HEX(" . $this->sColumn . "))";
        }

        /**
         * @param bool $bWithTable
         * @return string
         */
        public function toSQLColumnForSelect($bWithTable = true) {
            if ($bWithTable) {
                $aTableColumn = array($this->sTable, $this->sColumn);
                $sTableColumn = implode('.', $aTableColumn);
                $sTableColumn = "LOWER(HEX(" . $sTableColumn . "))";

                if (strlen($this->sAlias)) {
                    $aAliasColumn = array($this->sAlias, $this->sColumn);
                    $sAliasColumn = implode('_', $aAliasColumn);

                    return implode(' ', array($sTableColumn, "AS", $sAliasColumn));
                } else if (strlen($this->sTable)) {
                    return implode(' ', array($sTableColumn, "AS", $this->sColumn));
                }
            }

            return "LOWER(HEX(" . $this->sColumn . "))";
        }

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
?>
