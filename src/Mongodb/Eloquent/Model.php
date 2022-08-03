<?php
namespace  ImanRjb\Mongodb\Eloquent;

use ImanRjb\Mongodb\Query\Builder as QueryBuilder;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    /**
     * @inheritdoc
     */
    protected function newBaseQueryBuilder()
    {
        $connection = $this->getConnection();

        return new QueryBuilder($connection, $connection->getPostProcessor());
    }
}
