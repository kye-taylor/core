<?php

namespace App\Models\VisitTransfer\Facility;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VisitTransfer\Facility\Email
 *
 * @property int $id
 * @property int $facility_id
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VisitTransfer\Facility\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VisitTransfer\Facility\Email whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VisitTransfer\Facility\Email whereFacilityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VisitTransfer\Facility\Email whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\VisitTransfer\Facility\Email whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Email extends Model
{
    protected $table = 'vt_facility_email';
    protected $primaryKey = 'id';

    public $timestamps = true;
    public $fillable = [
        'facility_id',
        'email',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function facility()
    {
        $this->belongsTo(\App\Models\VisitTransfer\Facility::class);
    }
}