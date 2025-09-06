<?php
// Initialize game variables
$symbols = ['A', 'B', 'C'];
$totalWinnings = 0;
$spins = 0;
$maxSpins = 20;
$winningTarget = 500;
$results = [];

// Run the game loop
while ($totalWinnings < $winningTarget && $spins < $maxSpins) {
    $spins++;
    
    // Generate a spin
    $spinSymbols = [];
    for ($i = 0; $i < 3; $i++) {
        $randomIndex = array_rand($symbols);
        $spinSymbols[] = $symbols[$randomIndex];
    }
    $spinResult = implode('', $spinSymbols);
    
    // Determine payoff using match expression
    $payout = match($spinResult) {
        'AAA', 'BBB', 'CCC' => 100,
        'AAB', 'ABA', 'BAA', 'ABB', 'BBA', 'BAB',
        'BCC', 'CBC', 'CCB', 'ACC', 'CAC', 'CCA' => 50,
        default => 0
    };
    
    // Update results and track spins
    $totalWinnings += $payout;
    $results[] = "$spinResult payoff $payout";
}

// Output results
$index = 0;
foreach ($results as $result) {
    $index++;
    echo $index . $result . "<br>";
}

echo "Game over. Total winnings: $totalWinnings dollars\n";
?>