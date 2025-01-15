<?php 

// dd($transactions);

?>
<?php require_once __DIR__ . '/../components/head.php'; ?> 
<?php require_once __DIR__ . '/../components/header.php'; ?> 

<main class="px-1.5  text-gray-300">
    <div class="w-11/12 mt-10 mx-auto overflow-x-auto">
        <table id="table" class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-2 py-3">DATE</th>
                    <th class="px-2 py-3">TYPE</th>
                    <th class="px-2 py-3">COMPTE</th>
                    <th class="px-2 py-3">MONTANT</th>
                    <th class="px-2 py-3">DESCRIPTION</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($transactions as $transaction): ?>
                    <tr class="text-gray-700 text-center dark:text-gray-400">
                        <td class="px-2 py-3"><?= htmlspecialchars($transaction['created_at']) ?></td>
                        <td class="px-2 py-3">
                            <?php if ($transaction['transaction_type'] == 'depot'): ?>
                                <span class="bg-green-500 text-white rounded px-2"><?= htmlspecialchars($transaction['transaction_type']) ?></span>
                            <?php elseif ($transaction['transaction_type'] == 'retrait'): ?>
                                <span class="bg-red-500 text-white rounded px-2"><?= htmlspecialchars($transaction['transaction_type']) ?></span>
                            <?php else: ?>
                                <span class="bg-yellow-500 text-white rounded px-2"><?= htmlspecialchars($transaction['transaction_type']) ?></span>
                               
                            <?php endif; ?>
                        </td>
                        <td class="px-2 py-3">
                            <?= htmlspecialchars($transaction['account_number']) ?>
                        </td>
                        <td class="px-2 py-3">
                            <?php if ($transaction['transaction_type'] == 'depot'): ?>
                                <span class="text-green-500">+<?= htmlspecialchars($transaction['amount']) ?></span>
                            <?php elseif ($transaction['transaction_type'] == 'retrait'): ?>
                                <span class="text-red-500">-<?= htmlspecialchars($transaction['amount']) ?></span>
                            <?php else: ?>
                                <span class="text-yellow-500"><?= htmlspecialchars($transaction['amount']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="px-2 py-3">
                            <?php if ($transaction['transaction_type'] == 'depot'): ?>
                                <span>Deposit  d'un montant <?= htmlspecialchars($transaction['amount']) ?></span>
                            <?php elseif ($transaction['transaction_type'] == 'retrait'): ?>
                                <span>retrait d'un montant <?= htmlspecialchars($transaction['amount']) ?></span>
                            <?php elseif ($transaction['transaction_type'] == 'transfert'): ?>
                                <span>transfer vert le compte <?= htmlspecialchars($transaction['account_number']) ?> d'un montant <?= htmlspecialchars($transaction['amount']) ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>          
</main>

<?php require_once __DIR__ . '/../components/footer.php'; ?>



