<?php
    namespace Enobrev\ORM\Field;

    use Enobrev\ORM\Exceptions\DbException;
    use Enobrev\ORM\Escape;
    use Enobrev\ORM\Field;

    abstract class Number extends Field {
        public function __toString():string {
            return $this->sValue !== 0 ? (string) $this->sValue : '0';
        }

        /**
         * @return string
         * @throws DbException
         */
        public function toSQL(): string {
            return Escape::string($this->__toString());
        }
    }