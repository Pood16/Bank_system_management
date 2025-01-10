<?php require_once __DIR__ . '/../components/head.php'; ?> 
<?php require_once __DIR__ . '/../components/header.php'; ?> 

<?php 
$accounts = $_SESSION['accounts'];
?>

<form action="/transfer_d_argent" method="POST" class="w-9/12 bg-gray-800 mt-20 p-6 rounded-lg shadow-xl max-w-md mx-auto">
  <div class="mb-4">
    <label for="from_account" class="block text-sm font-medium text-gray-200 mb-2">From Account</label>
    <select id="from_account" name="from_account" class="block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-white">
      <?php foreach($accounts as $account):?>
        <?php if($account['account_type'] == 'courant'):?>
          <option value="<?=$account['id']?>"><?=$account['account_type']?> - <?=$account['account_number']?></option>
        <?php endif?>
      <?php endforeach?>
    </select>
  </div>
  <div class="mb-4">
    <label for="to_account" class="block text-sm font-medium text-gray-200 mb-2">To Account</label>
    <select id="to_account" name="to_account" class="block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-white">
      <?php foreach($accounts as $account):?>
          <option value="<?=$account['id']?>"><?=$account['account_type']?> - <?=$account['account_number']?></option>
      <?php endforeach?>
    </select>
  </div>
  <div class="mb-4">
    <label for="amount" class="block text-sm font-medium text-gray-200 mb-2">Amount</label>
    <input type="number" id="amount" name="amount" class="block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-white" placeholder="Enter amount" />
  </div>
  <div class="flex justify-center">
    <button type="submit" name="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-800">
      Transfer
    </button>
  </div>
</form>



<?php require_once __DIR__ . '/../components/footer.php'; ?>