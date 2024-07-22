<?php

    class Database {

        private $dbh;
        
        public function __construct( $host, $dbname, $username, $password ) {

            try {

                $this->dbh = new PDO( "mysql:host=$host;dbname=$dbname", $username, $password );
                $this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            } catch ( PDOException $e ) {

                $this->handleError( $e );

            }

        }

        private function handleError( PDOException $e ) {

            die("MySQLへの接続に失敗しました。<br>(" . $e->getMessage() . ")");

        }        

        public function insertSourceChannel( $channel, $shop ) {

            try {

                $sql = 'INSERT INTO source_channel (channel, shop) VALUES (:channel, :shop)';
                $stmt = $this->dbh->prepare( $sql );
                $stmt->bindValue( ':channel', $channel, PDO::PARAM_STR );
                $stmt->bindValue( ':shop', $shop, PDO::PARAM_STR );
                $stmt->execute();
                return "ご登録ありがとうございました！";

            } catch ( PDOException $e ) {

                $this->handleError( $e );

            }

        }

        public function getSourceChannels( $yearMonth ) {

            try {

                $sql = 'SELECT * FROM source_channel WHERE created_at LIKE ?';
                $stmt = $this->dbh->prepare( $sql );
                $stmt->execute( [$yearMonth . '%'] );
                return $stmt->fetchAll( PDO::FETCH_ASSOC );

            } catch ( PDOException $e ) {

                $this->handleError( $e );

            }

        }

        public function groupedByMonth() {

            try {

                $sql = 'SELECT DATE_FORMAT(created_at, "%Y-%m") AS month, COUNT(*) AS count FROM source_channel GROUP BY month';
                $stmt = $this->dbh->prepare( $sql );
                $stmt->execute();
                return $stmt->fetchAll( PDO::FETCH_ASSOC );

            } catch ( PDOException $e ) {

                $this->handleError( $e );

            }

        }

        public function getAdvertisingExpenses( $yearMonth ) {

            try {

                $sql = '
                    SELECT 
                        s.shop_name, 
                        ch.channel_shortname, 
                        ae.cost
                    FROM 
                        advertising_expenses ae
                    JOIN 
                        shops s ON ae.sid = s.sid
                    JOIN 
                        channels ch ON ae.cid = ch.cid
                    WHERE 
                        (
                            DATE_FORMAT(ae.start_date, "%Y-%m") = :yearMonth 
                            OR DATE_FORMAT(ae.end_date, "%Y-%m") = :yearMonth
                        )
                        OR (
                            NOT EXISTS (
                                SELECT 1
                                FROM advertising_expenses sub_ae
                                WHERE DATE_FORMAT(sub_ae.start_date, "%Y-%m") = :yearMonth 
                                OR DATE_FORMAT(sub_ae.end_date, "%Y-%m") = :yearMonth
                            )
                            AND ae.end_date IS NULL
                        )
                        AND ch.is_contracted = 1;
                ';
                $stmt = $this->dbh->prepare( $sql );
                $stmt->bindParam( ':yearMonth', $yearMonth );
                $stmt->execute();
                return $stmt->fetchAll( PDO::FETCH_ASSOC );

            } catch ( PDOException $e ) {

                $this->handleError( $e );

            }

        }

        public function getStoreSales( $yearMonth ) {

            try {

                $sql = '
                    SELECT 
                        s.shop_name, 
                        ss.gross_sales, 
                        ss.total_visitors,
                        ss.unit_price
                    FROM 
                        store_sales ss
                    JOIN 
                        shops s ON ss.sid = s.sid
                    WHERE 
                        DATE_FORMAT(ss.month, "%Y-%m") = :yearMonth;
                ';
                $stmt = $this->dbh->prepare( $sql );
                $stmt->bindParam( ':yearMonth', $yearMonth, PDO::PARAM_STR );
                $stmt->execute();
                return $stmt->fetchAll( PDO::FETCH_ASSOC );

            } catch ( PDOException $e ) {

                $this->handleError( $e );

            }

        }

        public function getShopSummary( $yearMonth ) {

            try {

                $createTableSQL = '
                    CREATE TEMPORARY TABLE temp_shop_summary (
                        shop VARCHAR(255),
                        count INT
                    );
                ';
                $this->dbh->exec( $createTableSQL );
    
                $insertSQL = '
                    INSERT INTO temp_shop_summary (shop, count)
                    SELECT 
                        shop, 
                        COUNT(*) AS count
                    FROM 
                        source_channel
                    WHERE 
                        DATE_FORMAT(created_at, "%Y-%m") = :yearMonth
                    GROUP BY 
                        shop
                    ORDER BY 
                        shop, 
                        count DESC;
                ';
                $stmt = $this->dbh->prepare( $insertSQL );
                $stmt->bindParam( ':yearMonth', $yearMonth, PDO::PARAM_STR );
                $stmt->execute();
    
                $selectSQL = 'SELECT * FROM temp_shop_summary;';
                $stmt = $this->dbh->query( $selectSQL );
                return $stmt->fetchAll( PDO::FETCH_ASSOC );
    
            } catch ( PDOException $e ) {

                $this->handleError( $e );

            }

        }

    }



