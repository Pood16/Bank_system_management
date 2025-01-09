<div
      x-show="isModalTwoOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    >
      <div
        x-show="isModalTwoOpen"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform translate-y-1/2"
        @click.away="closeModalTwo"
        @keydown.escape="closeModalTwo"
        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
        role="dialog"
        id="modal"
      >
        <header class="flex justify-end">
          <button
            class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
            aria-label="close"
            @click="closeModalTwo"
          >
            <svg
              class="w-4 h-4"
              fill="currentColor"
              viewBox="0 0 20 20"
              role="img"
              aria-hidden="true"
            >
              <path
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
                fill-rule="evenodd"
              ></path>
            </svg>
          </button>
        </header>
    <h2 class="text-2xl font-bold mb-6 text-center text-white">Deposit Money</h2>
    <span class="text-red-500">
        <?php if(isset($_SESSION['account_statu']) && !empty($_SESSION['account_statu'])){
            echo $_SESSION['account_statu'];
        } ?>
    </span>
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
            <label for="amount" class="block text-sm font-medium text-white mb-2">Amount</label>
            <input type="number" id="amount" name="amount" value="<?=isset($_SESSION['account_statu'])?'readonly':''?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter amount">
        </div>
        <div class="mb-4">
            <label for="account_id" class="block text-sm font-medium text-white mb-2">Account Name</label>
            <select id="account_id" name="account_id" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <?php foreach($accounts as $account): ?>
                    <option value="<?= $account['id'] ?>"><?= $account['account_number'] ?> - <?= $account['account_type'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
<footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
              <button
              onclick="window.location = '/user/accounts'"
                @click="closeModalTwo"
                type="button"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
              >
                Cancel
              </button>
              <button
                type="submit"
                name="submit"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
                Accept
              </button>
            </footer>
          </form>
      </div>
    </div> 
    <?php unset($_SESSION['failed']);
unset($_SESSION['success']); ?>