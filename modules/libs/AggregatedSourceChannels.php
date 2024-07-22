<?php

    class AggregatedSourceChannels {

        private $columns;
        private $rows;
        private $data;
        private $aggregatedData;

        public function __construct( array $columns, array $rows, array $data ) {

            $this->columns = $columns;
            $this->rows = $rows;
            $this->data = $data;
            $this->initializeAggregatedData();
            $this->aggregateData();

        }

        // 集計配列の初期化
        private function initializeAggregatedData() {

            $this->aggregatedData = [];

            foreach ( $this->rows as $row ) {

                $this->aggregatedData[$row] = array_fill_keys( array_values( $this->columns ), 0 );

            }

        }

        // sourceChannelsデータの集計     
        private function aggregateData() {

            foreach ( $this->data as $entry ) {

                $shop = $entry['shop'];                
                $channel = $entry['channel'];

                if ( isset( $this->aggregatedData[$shop][$channel] ) ) {

                    $this->aggregatedData[$shop][$channel]++;

                }

            }

        }

        public function getAggregatedData() {

            return $this->aggregatedData;

        }

    }



