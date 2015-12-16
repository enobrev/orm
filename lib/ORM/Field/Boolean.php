<?php
    namespace Enobrev\ORM\Field;

    use Enobrev\ORM\Field;

    class Boolean extends Number {
        /**
         *
         * @return string
         */
        public function __toString() {
            return $this->sValue ? '1' : '0';
        }

        /**
         *
         * @param mixed $sValue
         */
        public function setValue($sValue) {
            if ($sValue instanceof Field) {
                $sValue = $sValue->getValue();
            }

            $this->sValue = $sValue ? true : false;
        }

        /**
         * @return bool
         */
        public function isTrue() {
            return $this->sValue ? true : false;
        }

        /**
         * @return bool
         */
        public function isFalse() {
            return !$this->isTrue();
        }
    }
?>