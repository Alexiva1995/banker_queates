<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'day_start',
        'day_end',
        'time_start',
        'time_end',
        'percentage',
        'transferencias_entre_users',
    ];

    public function getFirtsDayOfWeek() {
        return $this->getDay($this->day_start);
    }

    public function getLastDayOfWeek() {
        return $this->getDay($this->day_end);
    }

    public function getDay($day) {
        switch ($day) {
            case 1:
                return 'Lunes';
                break;
            case 2:
                return 'Martes';
                break;
            case 3:
                return 'Miércoles';
                break;
            case 4:
                return 'Jueves';
                break;
            case 5:
                return 'Viernes';
                break;
            case 6:
                return 'Sábado';
                break;
            case 7:
                return 'Domingo';
                break;
            default:
                # code...
                break;
        }
    }
}
