<?php
/**
 * created by: Nikolay Tuzov
 */

namespace vendor\core;


use R;

class Db
{
    protected $pdo;
    protected static $instance;
    public static $countSql = 0;
    public static $queries = [];

    /**
     * Реализуем синглтон, поэтому конструктор protected
     * Db constructor.
     */
    protected function __construct()
    {
        $db = require ROOT . '/config/config_db.php';

        // Подключаем RedBean
        require LIBS . '/rb.php';
        $db = require '../config/config_db.php';
        R::setup($db['dsn'], $db['user'], $db['pass']);
        R::freeze(true);
//        R::fancyDebug(TRUE);


// Код, который использовался до подключения RedBean
//        $options = [
//            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
//            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
//        ];
//        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    /**
     * Получение ссылки на подключение к БД
     * @return Db
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // Код, который использовался до подключения RedBean
//    /**
//     * Выполнение указанного SQL-запроса
//     * @param $sql
//     * @param $params
//     * @return bool
//     */
//    public function execute($sql, $params = [])
//    {
//        self::$countSql++;
//        self::$queries[] = $sql;
//
//        $stmt = $this->pdo->prepare($sql);
//        return $stmt->execute($params);
//    }
//
//
//    /**
//     *  Получение данных из БД по указанному SQL-запросу
//     * @param $sql
//     * @param $params
//     * @return array
//     */
//    public function query($sql, $params = [])
//    {
//        self::$countSql++;
//        self::$queries[] = $sql;
//
//        $stmt = $this->pdo->prepare($sql);
//        $result = $stmt->execute($params);
//        if ($result !== false) {
//            return $stmt->fetchAll();
//        }
//
//        return [];
//    }
}