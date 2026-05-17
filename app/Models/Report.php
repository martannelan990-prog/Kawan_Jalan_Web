<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Report extends Model{ use HasFactory; protected $fillable=['user_id','guide_name','destination_name','guide_phone','group_link','description','status']; public function user(){return $this->belongsTo(User::class);} }
