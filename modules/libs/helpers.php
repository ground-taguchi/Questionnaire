<?php

    class ArrayShufflers {

        private $firstSet;
        private $secondSet;

        public function __construct( array $firstSet, array $secondSet ) {

            if ( count( $firstSet ) !== count( $secondSet ) ) {

                throw new InvalidArgumentException(" FirstSet and SecondSet arrays must have the same length. ");
            }

            $this->firstSet  = $firstSet;
            $this->secondSet = $secondSet;
        }

        public function shuffle() {

            // 配列を連想配列に結び付け
            $combined = array_map( null, $this->firstSet, $this->secondSet );

            // ランダムに並び替え
            shuffle( $combined );

            // ランダム後の配列を分解
            $this->firstSet  = array_column($combined, 0);
            $this->secondSet = array_column($combined, 1);

        }

        public function getFirstSet() {

            return $this->firstSet;

        }

        public function getSecondSet() {

            return $this->secondSet;

        }

    }

    class UrlParser {

        private $url;
    
        public function __construct( $url ) {

            $this->url = $url;

        }
    
        public function getSegment( $index ) {

            // パースしてパス部分を取得
            $parsedUrl = parse_url( $this->url, PHP_URL_PATH );
    
            // スラッシュで分割
            $pathSegments = explode( '/', trim( $parsedUrl, '/' ) );
    
            // 指定したインデックスのセグメントを取得
            if ( isset( $pathSegments[$index] ) ) {

                return $pathSegments[$index];

            } else {

                // インデックスが範囲外の場合
                return null;

            }

        }

    }



