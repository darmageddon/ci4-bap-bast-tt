<?php
namespace App\Database;

use CodeIgniter\Database\Postgre\Builder;

class PostgreBuilder extends Builder
{

    public function insertWithReturning(array $returning, ?array $set = null, ?bool $escape = null)
    {
        if ($set !== null) {
            $this->set($set, '', $escape);
        }

        if ($this->validateInsert() === false) {
            return false;
        }

        $sql = $this->_insert(
            $this->db->protectIdentifiers($this->QBFrom[0], true, $escape, false),
            array_keys($this->QBSet),
            array_values($this->QBSet)
        ) . ' RETURNING ' . implode(', ', $returning);

        if (! $this->testMode) {
            $this->resetWrite();

            $result = $this->db->query($sql, $this->binds, false);

            // Clear our binds so we don't eat up memory
            $this->binds = [];

            return $result;
        }

        return false;
    }
}