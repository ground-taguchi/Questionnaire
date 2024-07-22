<?php

    class CreateHtmlTag {

        private $data;
    
        public function __construct( $data ) {

            $this->data = $data;

        }
    
        public function renderTable( $tableClass = '', $sumClass = '' ) {

            echo "<table class='$tableClass'>";
            $this->renderTblHeader( $sumClass );
            $this->renderTblRows();
            $this->renderTblFooter( $sumClass );
            echo "</table>";

        }
    
        private function renderTblHeader( $sumClass ) {

            echo "<tr><th></th>";

            foreach ($this->data as $store => $values) {

                echo "<td scope='col'>$store</td>";

            }

            echo "<td class='$sumClass'>合計</td></tr>";

        }
    
        private function renderTblRows() {

            $categories = array_keys( $this->data[ array_key_first( $this->data ) ] );

            foreach ( $categories as $category ) {

                echo "<tr><th>$category</th>";
                $sum = 0;

                foreach ($this->data as $store => $values) {

                    $sum += $values[$category];
                    echo "<td>{$values[$category]}</td>";

                }

                echo "<td>$sum</td></tr>";

            }
        }
    
        private function renderTblFooter( $sumClass ) {

            echo "<tr><th class='$sumClass'>合計</th>";

            $totalSum = 0;

            foreach ($this->data as $store => $values) {

                $storeSum = array_sum($values);
                $totalSum += $storeSum;
                echo "<td>$storeSum</td>";

            }

            echo "<td>$totalSum</td></tr>";

        }

        public static function generateForm( $arrayData, $yearMonth ) {

            echo '<form method="GET" action=""><select name="month"><option value="">表示月を選択</option>';
            
            foreach ( $arrayData as $item ) {

                $month = htmlspecialchars( $item['month'], ENT_QUOTES, 'UTF-8' );
                $selected = ( $month === $yearMonth ) ? ' selected' : '';
                echo "<option value=\"{$month}\"{$selected}>{$month}</option>";

            }
            
            echo '</select></form>';

        }

    }


