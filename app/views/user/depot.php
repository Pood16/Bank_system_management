<?php require_once __DIR__ . '/../components/head.php'; ?> 
<?php require_once __DIR__ . '/../components/header.php'; ?> 




<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Deposit Money</h2>
    <span class="text-red-500"><?//=$errors['amount_error']?></span>
    <span class="text-green-500">
        <?php if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
            echo $_SESSION['success'];
        } ?>
    </span>
    <span class="text-red-500">
        <?php if(isset($_SESSION['failed']) && !empty($_SESSION['failed'])){
            echo $_SESSION['failed'];
        } ?>
    </span>
    
    <form action="/deposit" method="POST">
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
            <input type="number" id="amount" name="amount" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter amount">
        </div>
        <div class="flex justify-center">
            <button type="submit" name="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Deposit
            </button>
        </div>
    </form>
</div>
<?php
unset($_SESSION['failed']);
unset($_SESSION['success']);
?>





<?php require_once __DIR__ . '/../components/footer.php'; ?>