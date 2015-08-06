<?php

    namespace core\widgets;

    class calender
    {
        private $currentDate;
        private $monthDays;
        private $calenderHTML;

        public function __construct() {
            $this->currentDate = getdate();
            $this->monthDays = cal_days_in_month(CAL_GREGORIAN, $this->currentDate['mon'], $this->currentDate['year']);
        }

        public function getCalenderWidget() {
            $this->calenderHTML = '<calender>';
                $this->calenderHTML .= '<monthpicker><cmd data-command="previous"></cmd>' . $this->currentDate['month'] . '<cmd data-comand="next"></cmd></monthpicker>';
            $this->calenderHTML .= '</calender>';
        }
    }
