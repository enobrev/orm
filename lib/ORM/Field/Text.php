<?php
    namespace Enobrev\ORM\Field;

    use Enobrev\ORM\Db;
    use Enobrev\ORM\Field;

    class Text extends Field {

        /**
         *
         * @return mixed
         */
        public function getValue() {
            // Remove invalid UTF-8 Characters
            return mb_convert_encoding($this->sValue, 'UTF-8', 'UTF-8');
        }

        /**
         *
         * @return string
         */
        public function __toString() {
            return (string) $this->sValue;
        }
        
        /**
         *
         * @return string
         */
        public function toSQL() {
            if ($this->isNull()) {
                return '""';
            } else {
                return '"' . Db::getInstance()->real_escape_string((string) $this) . '"';
            }
        }

        /**
         * @return bool
         */
        public function hasValue() {
            return parent::hasValue() && strlen((string) $this) > 0;
        }
        
        /**
         *
         * @param mixed $sValue 
         */
        public function setValue($sValue) {
            if ($sValue instanceof Field) {
                $sValue = $sValue->getValue();
            }

            if ($sValue !== null) {
                $sValue = (string) $sValue;
            }

            $this->sValue = $sValue;
        }
    }
?>
