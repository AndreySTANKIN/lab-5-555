<!-- process.php -->
<?php

function getDivisors($number) {
    $divisors = [];
    
    for ($i = 1; $i <= $number; $i++) {
        if ($number % $i == 0) {
            $divisors[] = $i;
        }
    }
    
    return $divisors;
}

$number = $_POST['number'];
$action = $_POST['action'];

$divisors = [];
switch ($action) {
    case 'evenDivisors':
        $divisors = array_filter(getDivisors($number), function($divisor) {
            return $divisor % 2 == 0;
        });
        break;
        
    case 'oddDivisors':
        $divisors = array_filter(getDivisors($number), function($divisor) {
            return $divisor % 2 != 0;
        });
        break;
        
    case 'primeDivisors':
        $divisors = array_filter(getDivisors($number), function($divisor) {
            for ($i = 2; $i <= sqrt($divisor); $i++) {
                if ($divisor % $i == 0) {
                    return false;
                }
            }
            
            return true;
        });
        break;
        
    case 'compositeDivisors':
        $divisors = array_filter(getDivisors($number), function($divisor) {
            for ($i = 2; $i <= sqrt($divisor); $i++) {
                if ($divisor % $i == 0) {
                    return true;
                }
            }
            
            return false;
        });
        break;
        
    case 'allDivisors':
        $divisors = getDivisors($number);
        break;
}

echo '<html><head><title>Результат</title></head><body>';
echo '<h1>Результат</h1>';
echo '<p>Делители числа ' . $number . ':</p>';
echo '<ul>';
foreach ($divisors as $divisor) {
    echo '<li>' . $divisor . '</li>';
}
echo '</ul>';
echo '</body></html>';

?>
