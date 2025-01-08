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
    <main class="h-full overflow-y-auto mb-8">
        <div class="container px-6 mx-auto grid">

          <div class="flex items-center justify-between my-6">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Dashboard</h2>
            <button @click="openModal" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
              Create New User
            </button>
          </div>


          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Client</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Actions</th>
                  </tr>
                </thead>

                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($users as $user): ?>
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full" src="<?= $user['profile_pic']; ?>" alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <p class="font-semibold"><?= htmlspecialchars($user['email']); ?> </p> 
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-xs"><span class="px-2 py-1 font-semibold leading-tight <?= $user['role'] == 1 ? 'text-yellow-100' : 'text-green-100'; ?> <?= $user['role'] == 1 ? 'bg-yellow-700' : 'bg-green-700'; ?> rounded-full dark:<?= $user['role'] == 1 ? 'bg-yellow-700' : 'bg-green-700'; ?> dark:<?= $user['role'] == 1 ? 'text-yellow-100' : 'text-green-100'; ?>"> <?= $user['role'] == 1 ? 'Admin' : 'User'; ?> </span></td>
                    <td class="px-4 py-3 text-sm">
                      <span class=""> <?= htmlspecialchars($user['created_at']); ?> </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <div class="flex items-center space-x-4 text-sm">
                        <button @click="isModalTwoOpen = true" onclick="editUser(<?= $user['id']; ?>)" class="flex items-center justify-between text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-purple-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                          </svg>
                        </button>
                        <button onclick="deleteUser(<?= $user['id']; ?>)" class="flex items-center justify-between text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-red-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                          </svg>
                        </button>
                        <?php if ($user['is_banned'] == 0): ?>
                          <div x-data="{ isOpen: false, selectedAction: '' }" class="relative">
  <button @click="isOpen = !isOpen" class="flex items-center justify-between px-4 py-2 text-sm font-medium text-purple-600 bg-white border border-purple-600 rounded-md bg-transparent hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
    <span x-text="selectedAction || 'Actions'"></span>
    <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
    </svg>
  </button>
  <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5" style="z-index: 9999;">
    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
      <?php foreach ($user['accounts'] as $account): ?>
      <a href="#" @click="<?php echo $account['status'] == '0' ? 'ban('.$account['id'].')' : 'unban('.$account['id'].')' ?>; selectedAction = 'Ban'; ; isOpen = false" class="block px-4 py-2 text-sm <?php echo $account['status'] == '0' ? 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' : 'bg-red-600 text-white' ?> rounded-md" role="menuitem"><?= $account['account_type']; ?> - <?= $account['account_number']; ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
                        <?php else: ?>
                          <button onclick="unban(<?= $user['id']; ?>)" class="flex items-center justify-between text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-red-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                          </svg>                            
                        </button>
                        <?php endif; ?> 
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            
          </div>
          
      </main> 
    <?php require_once __DIR__ . '/../components/addUserModal.php'; ?>
    <?php require_once __DIR__ . '/../components/editUserModal.php'; ?>

    <script>

      function editUser(id) {
        fetch('/api/users?action=id&id=' + id)
          .then(response => response.json())
          .then(data => {
            document.querySelector('.editForm').querySelector('input[name="name"]').value = data.name;
            document.querySelector('.editForm').querySelector('input[name="email"]').value = data.email;
            document.querySelector('.editForm').querySelector('select[name="role"]').value = data.role;

          });
      }
      function deleteUser(id) {
        fetch('/api/users/delete?id=' + id)
          .then(response => response.text())
          .then(data => {
            location.reload();
          });
      }
      function ban(id) {
        fetch('/api/users/ban?id=' + id)
          .then(response => response.text())
          .then(data => {
            location.reload();
          });
      }
      function unban(id) {
        fetch('/api/users/unban?id=' + id)
          .then(response => response.text())
          .then(data => {
            location.reload();
          });
      }
    </script>
      
<?php require_once __DIR__ . '/../components/footer.php'; ?>