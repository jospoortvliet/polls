<?php
namespace OCA\Polls\Db;

use OCP\AppFramework\Db\Mapper;
use OCP\IDBConnection;

class TextMapper extends Mapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'polls_txts', '\OCA\Polls\Db\Text');
    }

    /**
     * @param int $id
     * @throws \OCP\AppFramework\Db\DoesNotExistException if not found
     * @throws \OCP\AppFramework\Db\MultipleObjectsReturnedException if more than one result
     * @return Text
     */
    public function find($id) {
        $sql = 'SELECT * FROM `*PREFIX*polls_txts` '.
            'WHERE `id` = ?';
        return $this->findEntity($sql, [$id]);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Text[]
     */
    public function findAll($limit=null, $offset=null) {
        $sql = 'SELECT * FROM `*PREFIX*polls_txts`';
        return $this->findEntities($sql, [], $limit, $offset);
    }

    /**
     * @param string $pollId
     * @param int $limit
     * @param int $offset
     * @return Text[]
     */
    public function findByPoll($pollId, $limit=null, $offset=null) {
        $sql = 'SELECT * FROM `*PREFIX*polls_txts` WHERE poll_id=?';
        return $this->findEntities($sql, [$pollId], $limit, $offset);
    }

    /**
     * @param string $pollId
     */
    public function deleteByPoll($pollId) {
        $sql = 'DELETE FROM `*PREFIX*polls_txts` WHERE poll_id=?';
        $this->execute($sql, [$pollId]);
    }
}
