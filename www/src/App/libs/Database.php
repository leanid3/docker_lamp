<?php 
namespace Lamp\Leanid3\App\libs;

class Database
{
    private $pdo;

    public function __construct(string $dsn, string $username, string $password)
    {
        $this->pdo = new \PDO($dsn, $username, $password);
    }
    /**
     * Вставка данных в таблицу
     * @param string $table
     * @param array $data
     * @return int|string
     */
    public function insert(string $table, array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $values = array_values($data);

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);
        return $this->pdo->lastInsertId();
    }

    /**
     * Обновление данных в таблице
     * @param string $table
     * @param array $data
     * @param array $criteria
     * @return int
     */
    public function update(string $table, array $data, array $criteria)
    {
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        $values = array_values($data);
        $where = implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($criteria)));
        $values = array_merge($values, array_values($criteria));

        $query = "UPDATE $table SET $set WHERE $where";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);
        return $stmt->rowCount();
    }

    /**
     * Удаление данных из таблицы
     * @param string $table
     * @param array $criteria
     * @return int
     */
    public function delete(string $table, array $criteria)
    {
        $where = implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($criteria)));
        $values = array_values($criteria);

        $query = "DELETE FROM $table WHERE $where";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);
        return $stmt->rowCount();
    }

    /**
     * Выборка данных из таблицы
     * @param string $table
     * @param array $criteria
     * @param array $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     */
    public function select(string $table, array $criteria = [], array $orderBy = [], int $limit = null, int $offset = null)
    {
        $where = implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($criteria)));
        $values = array_values($criteria);

        $query = "SELECT * FROM $table WHERE $where";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    
    
}