<?php

namespace App\Services\Admin;

use App\Models\TestTrainer;

class TestTrainerService
{

    public function handle($trainer, $request)
    {
        $trainer->subject = $request->subject;
        $trainer->price = $request->price;
        $trainer->description = $request->description;
        $trainer->installments = $request->installments;
        $trainer->is_active = $request->is_active;
        return $trainer;
    }

    public function save($trainer, $request)
    {
        $trainer = $this->handle($trainer, $request);
        return $trainer->save();
    }
}
