<?php

namespace Workbench\Database\Model\Bill;

use Illuminate\Database\Eloquent\Model;

class FavouriteAccount extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'favourite_account';

    public function fkpayeracc()
    {
        return $this->belongsTo('Workbench\Database\Model\Bill\PayerAccount','fk_payer_account');
    }












}
