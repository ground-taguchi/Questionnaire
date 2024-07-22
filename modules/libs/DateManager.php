<?php

    class DateManager {

        private $currentYear;
        private $currentMonth;

        public function __construct() {

            $this->currentYear = date("Y");
            $this->currentMonth = date("m");

        }

        public function getMonth() {

            $month = isset( $_GET['month'] ) ? $_GET['month'] : null;
            return $_GET['month'];

        }

        public function getYearMonth() {

            return $this->currentYear . '-' . sprintf( "%02d", $this->currentMonth );

        }

    }



