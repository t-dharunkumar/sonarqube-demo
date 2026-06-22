<?php

class PaymentService
{
    // Code Injection via eval() (php:S1523)
    public function applyDiscount(string $discountCode): float
    {
        $discount = 0;
        eval('$discount = ' . $discountCode . ';');
        return (float) $discount;
    }

    // XSS — raw user input echoed into HTML (php:S5131)
    public function greetUser(): void
    {
        $name = $_GET['name'] ?? 'Guest';
        echo "<h1>Welcome, " . $name . "!</h1>";
    }

    // Bug: always-false condition — unreachable code (php:S2583)
    public function getDiscount(float $amount): float
    {
        if ($amount > 100) {
            return 0.05;
        }

        if ($amount > 1000 && $amount < 500) { // impossible condition
            return 0.20;
        }

        return 0.0;
    }

    // Code Smell: Cognitive Complexity too high (php:S3776)
    public function calculateShipping(string $country, string $plan, float $weight, bool $isPriority): float
    {
        $cost = 0.0;
        if ($country === 'US') {
            if ($plan === 'premium') {
                if ($weight < 1.0) {
                    $cost = 0.0;
                } else {
                    if ($isPriority) {
                        if ($weight < 5.0) {
                            $cost = 5.99;
                        } else {
                            if ($weight < 10.0) {
                                $cost = 9.99;
                            } else {
                                $cost = 14.99;
                            }
                        }
                    } else {
                        $cost = 4.99;
                    }
                }
            } else {
                $cost = $isPriority ? 12.99 : 7.99;
            }
        } else {
            $cost = $plan === 'premium' ? 19.99 : 29.99;
        }
        return $cost;
    }
}
