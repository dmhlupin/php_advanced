<?php

namespace app\engine;

use app\traits\TSingletone;
use PDO;

class Db
{
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost:3307',
        'login' => 'root',
        'password' => '123456',
        'database' => 'shop',
        'charset' => 'utf8',
    ];

    use TSingletone; // Трейт - внедряет код, описанный в спецклассе trait в код основного класса

    private $connection = null; // Здесь будет объект класса PDO

    // функция getConnection формирует объект PDO и возвращает его для дальнейшей работы
    private function getConnection()
    {
        if(is_null($this->connection)) {
            $this->connection = new PDO($this->prepareDsnString(), 
                $this->config['login'], 
                $this->config['password']
            );
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    // функция prepareDsnString готовит Dsn строку для передачи в качестве аргумента конструктору объекта PDO
    private function prepareDsnString()
    {
        return  sprintf("%s:host=%s;dbname=%s;charset=%s",
        $this->config['driver'],
        $this->config['host'],
        $this->config['database'],
        $this->config['charset'],
        );
    }

    // функция query подготавливает и выполняет запрос с помощью методов PDO и возвращает объект из БД
    private function query($sql, $params)
    {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    // отдельный вид запросов для обработки LIMIT (чтобы исключить поведение PDO,когда параметры запроса оборачиваются в строку)
    private function queryLimit($sql, $page)
    {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(1, $page, PDO::PARAM_INT);
        return $stmt;
    }

    // ДЗ вернуть id
    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
    // возвращает массив
    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }
    // возвращает объект
    public function queryOneObject($sql, $params = [], $class)
    {
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        return $stmt->fetch();
    }

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }
}