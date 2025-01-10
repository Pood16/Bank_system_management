<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SwiftBank Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="/assets/js/focus-trap.js" defer></script>
  </head>
  <body>
    
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
 <?php require_once __DIR__ . '/../components/header.php'; ?> 
<div class="grid grid-cols-3 gap-4 p-4">
        <div class="space-y-4">
            <div class="bg-green-100 p-4 rounded-lg">
                <div class="text-green-800 font-semibold">Total des Dépôts</div>
                <div class="text-2xl font-bold text-green-600"><?= number_format($report['totalDeposits'], 2) ?> €</div>
            </div>

            <div class="bg-red-100 p-4 rounded-lg">
                <div class="text-red-800 font-semibold">Total des Retraits</div>
                <div class="text-2xl font-bold text-red-600"><?= number_format($report['totalWithdrawals'], 2) ?> €</div>
            </div>

            <div class="bg-blue-100 p-4 rounded-lg">
                <div class="text-blue-800 font-semibold">Solde Total</div>
                <div class="text-2xl font-bold text-blue-600"><?= number_format($report['totalBalance'], 2) ?> €</div>
            </div>
        </div>
</div>
<?php require_once __DIR__.'/../components/footer.php'; ?>
