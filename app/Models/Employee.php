<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'position', 'photo'];

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    // Accessor untuk Total Score Rata-rata
    public function getFinalScoreAttribute()
    {
        

        // Jika belum ada nilai, return 0
    if ($this->assessments->count() == 0) return 0;

    // Ambil rata-rata langsung dari kolom rating
    return $this->assessments->avg('rating');
    }
}
?>
