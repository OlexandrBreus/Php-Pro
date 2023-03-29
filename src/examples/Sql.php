<?php

namespace Core\Orm;
use PDO;

abstract class Sql
{
    protected PDO $connector;
    protected string $tableName;
    protected array $where;


    public function __construct()
    {
        $connector = new DBConnector();
        $this->connector = $connector->connect();

    }

    public function execute()
    {
        $sql = $this->buildQuery();
        $query = $this->connector->query($sql);
        $rows = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }

    abstract protected function buildQuery(): string;


        public function setTableName($tableName): self
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function setWhere(array $where): self
    {
        $this->where = $where;
        return $this;
    }

    public function getWhere(): string
    {
        $whereobj = new Where($this->where);
        return $whereobj->Where();
    }

}