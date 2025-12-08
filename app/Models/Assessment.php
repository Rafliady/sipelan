<?php
 namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = ['employee_id', 'surveyor_name', 'surveyor_phone', 'rating'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
    
?>