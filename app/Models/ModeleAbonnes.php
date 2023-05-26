<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleAbonnes extends Model
{

    protected $table = 'abonnes';
    protected $allowedFields = ['NOABONNE', 'MAIL'];
    protected $primaryKey = 'NOABONNE';

    public function retourner_abonnesParMail($mail = false)
    {
        return $this->where(['MAIL' => $mail])
            ->first();
    }



}