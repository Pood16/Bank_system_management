<?php require_once __DIR__.'/../components/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Rapport Global des Transactions</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total des Dépôts</div>
                <div class="card-body">
                    <h5 class="card-title"><?= number_format($report['totalDeposits'], 2) ?> €</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total des Retraits</div>
                <div class="card-body">
                    <h5 class="card-title"><?= number_format($report['totalWithdrawals'], 2) ?> €</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Solde Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?= number_format($report['totalBalance'], 2) ?> €</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__.'/../components/footer.php'; ?>
