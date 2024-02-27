<?php

namespace vfx;

abstract class Model
{

    public array $attributes = [];
    private object $db;
    protected string $table = '';
    private string $sql = '';
    private array $execute = [];

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->db = $this->db->getConnect();
        $controller = isset(Router::getRoute()['controller']) ? strtolower(Router::getRoute()['controller']) : null;
        $this->table = !empty($this->table) ? $this->table : $controller;
    }

    public function load(array $data): void
    {
        if(count($this->attributes) > 0) {
            foreach ($this->attributes as $name => $value) {
                if(isset($data[$name])) {
                    $this->attributes[$name] = $data[$name];
                }
            }
        }
    }

    public function select(string $column = '*'): object
    {
        $this->sql = "SELECT $column FROM `{$this->table}` ";

        if(!empty($this->table)) {
            try {
                return $this;
            } catch (\Exception $e) {
                throw new \Exception("Ошибка при работе с БД {$e->getMessage()}", 500);
            }
        }

        throw new \Exception("Ошибка при работе с БД", 500);
    }

    public function leftjoin(string $table, string $search, string $operator, string $value)
    {
        $this->sql .= " LEFT JOIN {$table} ON {$search} {$operator} $value ";

        return $this;
    }

    public function where(string $search, string $operator, string $value): object
    {
        $this->sql .= " WHERE {$search} {$operator} ? ";
        $this->execute[] = $value;
        return $this;
    }

    public function andWhere(string $search, string $operator, string $value): object
    {
        $this->sql .= " AND {$search} {$operator} ? ";
        $this->execute[] = $value;

        return $this;
    }
   public function whereNull(string $search, $operator = 'AND'): object
    {
        if(isset($this->execute) && count($this->execute) > 0) {
            $this->sql .= " {$operator} {$search} IS NULL";
        } else {
            $this->sql .= " WHERE {$search} IS NULL";
        }

        return $this;
    }

    public function whereNotNull(string $search): object
    {
        $this->sql .= " WHERE {$search} IS NOT NULL";

        return $this;
    }

    public function order(string $sql): object
    {
        $this->sql .= " ORDER BY {$sql}";
        return $this;
    }

    public function limit(int $limit): object
    {
        $this->sql .= " LIMIT {$limit} ";
        return $this;
    }

    public function offset(int $offset): object
    {
        $this->sql .= " OFFSET {$offset} ";
        return $this;
    }

    public function get($mode = 'fetchAll'): mixed
    {
        try {
            $sth = $this->db->prepare($this->sql);

            $sth->execute($this->execute);

            return $sth->{$mode}();

        } catch (\Exception $e) {
            return null;
        }
    }

    public function findAll(): array
    {
        return $this->db->query($this->sql)->fetchAll();
    }

    public function update(array $set = []): object
    {
        if(count($set) > 0) {
            $this->sql = "UPDATE `{$this->table}` SET ";
            foreach ($set as $key => $value) {
                $this->sql .= "{$key} = '{$value}', ";
            }
            $this->sql = rtrim($this->sql, ', ');
        }

        if(!empty($this->table)) {
            try {
                return $this;
            } catch (\Exception $e) {
                throw new \Exception("Ошибка при работе с БД {$e->getMessage()}", 500);
            }
        }

        throw new \Exception("Ошибка при работе с БД", 500);
    }

    public function insert(array $values = []): object
    {
        if(count($values) > 0) {
            $this->sql = "INSERT INTO `{$this->table}` ( ";
            foreach ($values as $key => $value) {
                $this->sql .= "{$key}, ";
            }
            $this->sql = rtrim($this->sql, ', ');
            $this->sql .= ' ) VALUES  (';
            foreach ($values as $key => $value) {
                $this->sql .= "'{$value}', ";
            }
            $this->sql = rtrim($this->sql, ', ');
            $this->sql .= ' ) ';

        }

        if(!empty($this->table)) {
            try {
                return $this;
            } catch (\Exception $e) {
                throw new \Exception("Ошибка при работе с БД {$e->getMessage()}", 500);
            }
        }

        throw new \Exception("Ошибка при работе с БД", 500);
    }

    public function execute()
    {
        try {
            $sth = $this->db->prepare($this->sql);

            return $sth->execute($this->execute);

        } catch (\Exception $e) {
            return null;
        }

    }

    public function lastInsertId(): int|null
    {
        return $this->db->lastInsertId() != 0 ? $this->db->lastInsertId() : null;
    }

}