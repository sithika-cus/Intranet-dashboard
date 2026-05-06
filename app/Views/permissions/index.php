<?php /* app/Views/permissions/index.php */ ?>

<style>
.ap-page { padding: 20px; }
.ap-header { display:flex; align-items:center; margin-bottom:20px; }
.ap-header h2 { font-size:1.2rem; font-weight:700; color:#0f1117; margin:0; }
.ap-table { width:100%; border-collapse:collapse; background:#fff; border-radius:10px; overflow:hidden; border:1px solid #e5e1db; }
.ap-table th { background:#f9f7f4; padding:12px 16px; font-size:0.82rem; font-weight:700; color:#444; text-align:left; border-bottom:1px solid #e5e1db; }
.ap-table th.center { text-align:center; }
.ap-table td { padding:12px 16px; font-size:0.85rem; color:#2b2f3a; border-bottom:1px solid #f3f1ee; vertical-align:middle; }
.ap-table td.center { text-align:center; }
.ap-table tr:last-child td { border-bottom:none; }
.ap-table tr:hover td { background:#fafaf8; }
.ap-badge { display:inline-block; padding:3px 10px; border-radius:20px; font-size:0.72rem; font-weight:700; }
.ap-badge-admin { background:#fde8e8; color:#c0392b; }
.ap-badge-user  { background:#e8f4fd; color:#2471a3; }
.ap-check { width:18px; height:18px; accent-color:#c8522a; cursor:pointer; }
.ap-save-btn {
  background:#c8522a; color:#fff; border:none;
  padding:5px 14px; border-radius:6px; font-size:0.78rem;
  font-weight:600; cursor:pointer; transition:all 0.18s;
}
.ap-save-btn:hover { background:#a84020; }
.ap-save-btn.saved { background:#2e7d32; }
.ap-admin-note { font-size:0.78rem; color:#6b7280; font-style:italic; }

.ap-table th {
  font-size: 1.22rem;
}
.ap-table td {
  font-size: 1.22rem;
}
.ap-header h2 {
  font-size: 1.44rem;
}
.ap-badge {
  font-size: 1.1rem;
  padding: 5px 14px;
}

.ap-save-btn {
  font-size: 1.1rem;
  padding: 7px 18px;
}
</style>

<div class="ap-page">
  <div class="ap-header">
    <h2>
      <i class="fa fa-shield" style="color:#c8522a;margin-right:8px;"></i>
      User Permissions
    </h2>
  </div>

  <table class="ap-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Role</th>
        <th class="center">Add</th>
        <th class="center">Edit</th>
        <th class="center">Delete</th>
        <th class="center">View</th>
        <th class="center">Save</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($users as $u): ?>
      <tr id="user-row-<?= $u['id'] ?>">
        <td>
  <?= esc($u['display_name']) ?>
  <span style="font-size:0.75rem;color:#6b7280;">
    (<?= esc($u['username'] ?? $u['email']) ?>)
  </span>
</td>
        <td>
          <span class="ap-badge <?= $u['role'] === 'admin' ? 'ap-badge-admin' : 'ap-badge-user' ?>">
            <?= esc($u['role']) ?>
          </span>
        </td>

        <?php if($u['role'] === 'admin'): ?>
          <td class="center" colspan="4">
            <span class="ap-admin-note">Full access always</span>
          </td>
          <td class="center">—</td>
        <?php else: ?>
          <td class="center">
            <input type="checkbox" class="ap-check" id="add-<?= $u['id'] ?>"
                   <?= $u['can_add'] ? 'checked' : '' ?>>
          </td>
          <td class="center">
            <input type="checkbox" class="ap-check" id="edit-<?= $u['id'] ?>"
                   <?= $u['can_edit'] ? 'checked' : '' ?>>
          </td>
          <td class="center">
            <input type="checkbox" class="ap-check" id="delete-<?= $u['id'] ?>"
                   <?= $u['can_delete'] ? 'checked' : '' ?>>
          </td>
          <td class="center">
            <input type="checkbox" class="ap-check" id="view-<?= $u['id'] ?>"
                   <?= $u['can_view'] ? 'checked' : '' ?>>
          </td>
          <td class="center">
            <button class="ap-save-btn" onclick="savePerms(<?= $u['id'] ?>, this)">
              <i class="fa fa-check"></i> Save
            </button>
          </td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
function savePerms(userId, btn) {
  const BASE = typeof BASE_URL !== 'undefined' ? BASE_URL : '/';
  const payload = {};
  if (document.getElementById('add-'    + userId)?.checked) payload.can_add    = 1;
  if (document.getElementById('edit-'   + userId)?.checked) payload.can_edit   = 1;
  if (document.getElementById('delete-' + userId)?.checked) payload.can_delete = 1;
  if (document.getElementById('view-'   + userId)?.checked) payload.can_view   = 1;

  const orig = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';

  $.post(BASE + 'action-permissions/save/' + userId, payload, function(res) {
    if (res.success) {
      btn.innerHTML = '<i class="fa fa-check"></i> Saved!';
      btn.classList.add('saved');
      setTimeout(() => {
        btn.innerHTML = orig;
        btn.classList.remove('saved');
        btn.disabled = false;
      }, 2000);
    }
  }).fail(function() {
    btn.innerHTML = orig;
    btn.disabled  = false;
    alert('Failed to save permissions');
  });
}
</script>