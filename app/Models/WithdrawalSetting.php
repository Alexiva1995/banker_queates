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
                return 'Monday';
                break;
            case 2:
                return 'Tuesday';
                break;
            case 3:
                return 'Wednesday';
                break;
            case 4:
                return 'Thursday';
                break;
            case 5:
                return 'Friday';
                break;
            case 6:
                return 'Saturday';
                break;
            case 7:
                return 'Sunday';
                break;
            default:
                # code...
                break;
        }
    }
}
