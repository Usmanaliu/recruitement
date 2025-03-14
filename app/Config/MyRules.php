<?php

namespace App\Config;

class MyRules {
    public function past_date(string $date, ?string $fields = null, array $data = []): bool {
        return strtotime($date) < time(); // Check if the date is in the past
    }
}

