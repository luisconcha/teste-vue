<?php

namespace LACC\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model implements TableInterface
{
    protected $fillable = ['name'];

    /**
     * @return array
     */
    public function getTableHeaders()
    {
        return ['ID', 'Name'];
    }

    /**
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case 'ID':
                return $this->id;
            case 'Name':
                return $this->name;
        }
    }
}
