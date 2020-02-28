<?php namespace VKBot;

use PDO;

class Database
{
    private $pdo;
    private static $instant;

    private function __construct()
    {
        $this->pdo = new PDO(
            (getenv('DB_DRIVER') .
                ':host=' . getenv('DB_HOST') .
                ((!empty(getenv('DB_PORT'))) ? (';port=' . getenv('DB_PORT')) : '') .
                ';dbname=' . getenv('DB_DATABASE')),
            getenv('DB_USER'), getenv('DB_PASSWORD')
        );
        $this->pdo->exec('SET NAMES UTF8');

        $this->createTables();
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if ($result === false) return null;
        return $sth->fetchAll(PDO::FETCH_CLASS, $className);
    }

    public static function getInstant(): self
    {
        if (self::$instant == null) {
            self::$instant = new self();
        }
        return self::$instant;
    }

    private function createTables(): void
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `posts` (`post_id` INT NOT NULL)';
        $this->query($sql);
    }

    public function checkExistPost(int $post_id): bool
    {
        $sql = "SELECT * FROM `posts` WHERE `post_id` = '{$post_id}';";
        $result = $this->query($sql);
        if (!count($result)) return false;
        return true;
    }

    public function insertPost(int $post_id): void
    {
        $sql = "INSERT INTO `posts` (`post_id`) VALUES ('{$post_id}');";
        $this->query($sql);
    }
}
