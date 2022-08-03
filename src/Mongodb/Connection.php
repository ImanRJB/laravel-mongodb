<?php
namespace ImanRjb\Mongodb;


use Jenssegers\Mongodb\Connection as JenssegersConnection;
use ImanRjb\Mongodb\Query\Builder;

class Connection extends JenssegersConnection
{
    protected $session;


    public function beginTransaction(array $options = [])
    {
        if (!$this->getSession()) {
            $this->session = $this->getMongoClient()->startSession();
            $this->session->startTransaction($options);
        }
    }


    public function commit()
    {
        if ($this->getSession()) {
            $this->session->commitTransaction();
            $this->clearSession();
        }
    }


    public function rollBack($toLevel = null)
    {
        if ($this->getSession()) {
            $this->session->abortTransaction();
            $this->clearSession();
        }
    }


    protected function clearSession()
    {
        $this->session = null;
    }

    /**
     *
     * @param string $collection
     * @return Builder|\Jenssegers\Mongodb\Query\Builder
     * @date 2019-07-22
     */
    public function collection($collection)
    {
        $query = new Query\Builder($this, $this->getPostProcessor());

        return $query->from($collection);
    }

    public function getSession()
    {
        return $this->session;
    }
}