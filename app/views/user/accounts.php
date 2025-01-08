<?php require_once __DIR__ . '/../components/head.php'; ?> 
<?php require_once __DIR__ . '/../components/header.php'; ?> 





<h2 class="text-2xl font-bold text-white text-center mt-10">Mes Comptes</h2>
<div class="grid grid-cols-2 gap-10 mt-10 p-8 mx-auto">

    <!-- Compte Courant -->
    <div class="mt-6 bg-white rounded-lg shadow">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Compte Courant</h3>
                    <p class="text-sm text-gray-500">N° FR76 1234 5678 9012</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-gray-900">€2,450.50</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Actif
                    </span>
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50">
                    <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                    Alimenter
                </button>
                <button class="flex items-center justify-center p-3 text-purple-600 border border-purple-600 rounded-lg hover:bg-purple-50">
                    <i data-lucide="download" class="w-5 h-5 mr-2"></i>
                    Relevé
                </button>
            </div>

            <div class="mt-6">
                <h4 class="font-medium text-gray-700">Détails du compte</h4>
                <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm text-gray-500">Date d'ouverture</dt>
                        <dd class="mt-1 text-sm text-gray-900">15 janvier 2020</dd>
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
                    <p class="text-sm text-gray-500">N° FR76 9876 5432 1098</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-gray-900">€15,750.20</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Actif
                    </span>
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-2 gap-4">
                <button onclick="toggleModal('epargne')" class="flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50">
                    <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                    Alimenter
                </button>
                
                <!-- Dans le Compte Épargne -->
                <button onclick="toggleModal('epargne')" class="flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50">
                    <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                    Alimenter
                </button>
            </div>

            <div class="mt-6">
                <h4 class="font-medium text-gray-700">Détails du compte</h4>
                <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm text-gray-500">Date d'ouverture</dt>
                        <dd class="mt-1 text-sm text-gray-900">20 mars 2020</dd>
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






<?php require_once __DIR__ . '/../components/footer.php'; ?>