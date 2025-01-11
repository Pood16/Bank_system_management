<?php require_once __DIR__ . '/../components/head.php'; ?> 
<?php require_once __DIR__ . '/../components/header.php'; ?> 

<div class="flex items-center justify-between my-6 m-4">
      <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Mes Comptes</h2>
      <div>

          <button @click="isModalTwoOpen = true" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Depot Money
          </button>
    
          <button @click="isModal3Open = true" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Retrait Money
          </button>
      </div>
</div>


<div class="grid grid-cols-1 gap-10 mt-10 p-8 mx-auto border border-1-black w-11/12 md:grid-cols-2">

    <!-- Compte Courant -->
    <div class="mt-6 bg-white rounded-lg shadow">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Compte : Courant</h3>
                    <p class="text-sm text-gray-500"> numero de compte :  <span><?=$accounts[0]['account_number']?></span></p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-gray-900"><span>€<?=$accounts[0]['balance']?></span></p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <?=($accounts[0]['status']==0)?'Actif':'blocked'?>
                    </span>
                </div>
            </div>
            
            

            <div class="mt-6">
                <h4 class="font-medium text-gray-700">Détails du compte</h4>
                <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm text-gray-500">Date d'ouverture</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?=$accounts[0]['created_at']?></dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Plafond de retrait</dt>
                        <dd class="mt-1 text-sm text-gray-900">1000€ / jour</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Découvert autorisé</dt>
                        <dd class="mt-1 text-sm text-gray-900">500€</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Frais de tenue</dt>
                        <dd class="mt-1 text-sm text-gray-900">2€ / mois</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Compte Épargne -->
    <div class="mt-6 bg-white rounded-lg shadow">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Compte Épargne</h3>
                    <p class="text-sm text-gray-500">numero de compte :  <span><?=$accounts[1]['account_number']?></span></p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-gray-900">€<?=$accounts[1]['balance']?></p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <?=($accounts[1]['status']==0)?'Actif':'blocked'?>
                    </span>
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-2 gap-4">
                <!-- Dans le Compte Épargne -->
                
            </div>

            <div class="mt-6">
                <h4 class="font-medium text-gray-700">Détails du compte</h4>
                <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm text-gray-500">Date d'ouverture</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?=$accounts[1]['created_at']?></dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Taux d'intérêt</dt>
                        <dd class="mt-1 text-sm text-gray-900">2.5% annuel</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Plafond</dt>
                        <dd class="mt-1 text-sm text-gray-900">50 000€</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Frais de tenue</dt>
                        <dd class="mt-1 text-sm text-gray-900">Gratuit</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>





<?php require_once __DIR__ . '/../components/depotModal.php'; ?>
<?php require_once __DIR__ . '/../components/releveModal.php'; ?>

<?php if(isset($_GET['action']) && $_GET['action'] == 'depot'): ?>
    <script>setTimeout(() => { document.querySelector('[x-data]').__x.$data.isModalTwoOpen = true; }, 500);</script>
<?php endif; ?>
<?php if(isset($_GET['action']) && $_GET['action'] == 'retrait'): ?>
    <script>setTimeout(() => { document.querySelector('[x-data]').__x.$data.isModal3Open = true; }, 500);</script>
<?php endif; ?>
<?php 

unset($_SESSION['failed']);
unset($_SESSION['success']);

?>
<?php require_once __DIR__ . '/../components/footer.php'; ?>