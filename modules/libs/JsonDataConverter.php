<?php

    // namespace Roas\Analysis;

    class JsonDataConverter {

        private $filePath;
        private $dataArray;
    
        public function __construct( $filePath ) {

            $this->filePath = $filePath;
            $this->loadJson();
            $this->transformData();

        }
    
        private function loadJson() {

            // JSONファイルの内容を読み込む
            $jsonContent = file_get_contents( $this->filePath );
            
            // JSONデータをPHPの配列に変換する
            $this->dataArray = json_decode( $jsonContent, true );

        }
    
        private function transformData() {

            // 配列の構造を変更する
            $transformedArray = [];

            foreach ( $this->dataArray as $item ) {

                $key = key( $item );
                $value = $item[$key];
                $transformedArray[$key] = $value;

            }

            $this->dataArray = $transformedArray;

        }
    
        public function getDataArray() {

            return $this->dataArray;

        }

    }    

