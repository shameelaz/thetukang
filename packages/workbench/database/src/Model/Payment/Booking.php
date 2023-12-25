<?php

namespace Workbench\Database\Model\Payment;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'booking';

    public function mainservice()
    {
        return $this->belongsTo('Workbench\Database\Model\Agency\MainService','fk_main_service', 'id');
    }
    public function attachmentbooking()
    {
        return $this->hasMany('Workbench\Database\Model\Payment\AttachmentBooking','fk_booking', 'id');
    }
    public function attachmenthandymanbooking()
    {
        return $this->hasMany('Workbench\Database\Model\Payment\AttachmentHandymanBooking','fk_booking', 'id');
    }
    public function user()
    {
        return $this->belongsTo('Workbench\Database\Model\User\Users','fk_user');
    }
    public function rating()
    {
        return $this->belongsTo('Workbench\Database\Model\Payment\Rating','fk_lkp_rating', 'id');
    }
    
}
