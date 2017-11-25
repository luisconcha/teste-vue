<?php

namespace LACC\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class ClassInformation extends Model implements TableInterface
{
    protected $fillable = [
        'date_start',
        'date_end',
        'cycle',
        'subdivision',
        'semester',
        'year'
    ];

    protected $dates = [
        'date_start',
        'date_end',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }


    /**
     * @return array
     */
    public function getTableHeaders()
    {
        return ['ID', 'Start date', 'Final date', 'Cycle', 'Subdivision', 'Half', 'Year'];
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
            case 'Start date':
                return $this->date_start->format('d/m/Y');
            case 'Final date':
                return $this->date_end->format('d/m/Y');
            case 'Cycle':
                return $this->cycle;
            case 'Subdivision':
                return $this->subdivision;
            case 'Half':
                return $this->semester;
            case 'Year':
                return $this->year;
        }
    }
}
