<?php /* app/Views/groups/index.php */ ?>

<style>
.g-page { padding: 20px; }
.g-header {
  display: flex; align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
}
.g-header h2 { font-size: 1.2rem; font-weight: 700; color: #0f1117; margin: 0; }
.g-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; }
.g-card {
  background: #fff; border: 1px solid #e5e1db;
  border-radius: 10px; padding: 20px;
  transition: box-shadow 0.18s, transform 0.18s;
  min-width: 0;
}
.g-card:hover { box-shadow: 0 4px 18px rgba(0,0,0,0.1); transform: translateY(-2px); }
.g-card-icon {
  width: 44px; height: 44px; border-radius: 10px;
  background: linear-gradient(135deg, #c8522a, #e8845e);
  display: flex; align-items: center; justify-content: center;
  color: #fff; font-size: 1.2rem; margin-bottom: 12px;
}
.g-card-name { font-size: 1rem; font-weight: 700; color: #0f1117; margin-bottom: 4px; }
.g-card-desc { font-size: 0.82rem; color: #6b7280; margin-bottom: 14px; line-height: 1.5; min-height: 36px; }
.g-card-footer { display: flex; align-items: center; justify-content: space-between; }
.g-card-members { font-size: 0.78rem; color: #6b7280; }
.g-btn {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 7px 14px; border-radius: 7px;
  font-size: 0.8rem; font-weight: 600;
  cursor: pointer; border: none; transition: all 0.18s;
  text-decoration: none;
}
.g-btn-primary { background: #c8522a; color: #fff; }
.g-btn-primary:hover { background: #a84020; color: #fff; }
.g-btn-outline { background: transparent; color: #c8522a; border: 1.5px solid #c8522a; }
.g-btn-outline:hover { background: #fef2ef; }
.g-btn-pending { background: #f9f7f4; color: #6b7280; border: 1.5px solid #e5e1db; cursor: default; }
.g-btn-member { background: #e8f5e9; color: #2e7d32; border: 1.5px solid #c8e6c9; }
.g-modal-overlay {
  position: fixed; inset: 0; background: rgba(0,0,0,0.5);
  z-index: 9999; display: flex; align-items: center; justify-content: center;
}
.g-modal { background: #fff; border-radius: 12px; padding: 28px; width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
.g-modal h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 18px; }
.g-form-group { margin-bottom: 14px; }
.g-form-group label { display: block; font-size: 0.82rem; font-weight: 600; color: #444; margin-bottom: 5px; }
.g-form-control {
  width: 100%; border: 1px solid #ddd; border-radius: 7px;
  padding: 9px 12px; font-size: 0.88rem; outline: none;
  transition: border-color 0.2s; font-family: inherit;
}
.g-form-control:focus { border-color: #c8522a; }
.g-modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
</style>

<div class="g-page">
  <div class="g-header">
    <h2><i class="fa fa-users" style="color:#c8522a;margin-right:8px;"></i> Groups</h2>
    <button class="g-btn g-btn-primary"
            onclick="document.getElementById('g-create-modal').style.display='flex'">
      <i class="fa fa-plus"></i> Create Group
    </button>
  </div>

  <div class="g-grid">
    <?php foreach($groups as $g): ?>
    <div class="g-card">
      <div class="g-card-icon"><i class="fa fa-users"></i></div>
      <div class="g-card-name"><?= esc($g['name']) ?></div>
      <div class="g-card-desc"><?= esc($g['description'] ?: 'No description') ?></div>
      <div class="g-card-footer">
        <span class="g-card-members">
          <i class="fa fa-user"></i> <?= $g['member_count'] ?? 0 ?> Members
        </span>
        <div style="display:flex;gap:6px;align-items:center;">

          <?php if(session()->get('role') === 'admin'): ?>
            <button class="g-btn g-btn-outline"
                    style="color:#c0392b;border-color:#c0392b;"
                    onclick="deleteGroup(<?= $g['id'] ?>, this)">
              <i class="fa fa-trash"></i>
            </button>
          <?php endif; ?>

          <?php if($g['member_status'] === 'approved'): ?>
            <a href="#" class="g-btn g-btn-member load-page"
               data-url="<?= base_url('groups/feed/' . $g['id']) ?>">
              <i class="fa fa-sign-in"></i> Open
            </a>
          <?php else: ?>
            <button class="g-btn g-btn-outline"
                    onclick="requestJoin(<?= $g['id'] ?>, this)">
              <i class="fa fa-plus"></i> Join
            </button>
          <?php endif; ?>

          <?php if(session()->get('role') === 'admin'): ?>
            <a href="#" class="g-btn g-btn-primary load-page"
               data-url="<?= base_url('groups/feed/' . $g['id']) ?>">
              <i class="fa fa-cog"></i> Manage
            </a>
          <?php endif; ?>

        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Create Group Modal — available to all users -->
<div id="g-create-modal" class="g-modal-overlay" style="display:none;">
  <div class="g-modal">
    <h3><i class="fa fa-users" style="color:#c8522a;margin-right:8px;"></i> Create New Group</h3>
    <div class="g-form-group">
      <label>Group Name</label>
      <input type="text" id="g-name" class="g-form-control" placeholder="e.g. IT Department">
    </div>
    <div class="g-form-group">
      <label>Description</label>
      <textarea id="g-desc" class="g-form-control" rows="3"
                placeholder="What is this group about?"></textarea>
    </div>
    <div class="g-modal-actions">
      <button class="g-btn g-btn-outline"
              onclick="document.getElementById('g-create-modal').style.display='none'">
        Cancel
      </button>
      <button class="g-btn g-btn-primary" onclick="createGroup()">
        <i class="fa fa-check"></i> Create
      </button>
    </div>
  </div>
</div>

<script>
const isAdmin = <?= session()->get('role') === 'admin' ? 'true' : 'false' ?>;

function createGroup() {
  const BASE = typeof BASE_URL !== 'undefined' ? BASE_URL : '/';
  const name = document.getElementById('g-name').value.trim();
  const desc = document.getElementById('g-desc').value.trim();
  if (!name) { alert('Please enter a group name'); return; }

  $.post(BASE + 'groups/create', { name, description: desc }, function(res) {
    if (res.success) {
      document.getElementById('g-create-modal').style.display = 'none';
      document.getElementById('g-name').value = '';
      document.getElementById('g-desc').value = '';

      const grid = document.querySelector('.g-grid');
      const card = document.createElement('div');
      card.className = 'g-card';
      card.dataset.groupId = res.id;
      card.innerHTML = `
        <div class="g-card-icon"><i class="fa fa-users"></i></div>
        <div class="g-card-name">${name}</div>
        <div class="g-card-desc">${desc || 'No description'}</div>
        <div class="g-card-footer">
          <span class="g-card-members"><i class="fa fa-user"></i> 1 Members</span>
          <div style="display:flex;gap:6px;align-items:center;">
            ${isAdmin ? `
              <button class="g-btn g-btn-outline"
                      style="color:#c0392b;border-color:#c0392b;"
                      onclick="deleteGroup(${res.id}, this)">
                <i class="fa fa-trash"></i>
              </button>` : ''}
            <a href="#" class="g-btn g-btn-member load-page"
               data-url="${BASE}groups/feed/${res.id}">
              <i class="fa fa-sign-in"></i> Open
            </a>
            ${isAdmin ? `
              <a href="#" class="g-btn g-btn-primary load-page"
                 data-url="${BASE}groups/feed/${res.id}">
                <i class="fa fa-cog"></i> Manage
              </a>` : ''}
          </div>
        </div>`;

      grid.appendChild(card);
      card.querySelectorAll('.load-page').forEach(el => {
        el.addEventListener('click', function(e) {
          e.preventDefault();
          loadPage(this.dataset.url);
        });
      });
    }
  });
}

function deleteGroup(groupId, btn) {
  if (!confirm('Are you sure you want to delete this group? This cannot be undone.')) return;
  const BASE = typeof BASE_URL !== 'undefined' ? BASE_URL : '/';
  const card = btn.closest('.g-card');
  card.style.opacity = '0';
  card.style.transition = 'opacity 0.25s';
  $.post(BASE + 'groups/delete/' + groupId, function(res) {
    if (res.success) {
      setTimeout(() => card.remove(), 260);
    } else {
      card.style.opacity = '1';
      alert('Failed to delete group.');
    }
  });
}

function requestJoin(groupId, btn) {
  const BASE = typeof BASE_URL !== 'undefined' ? BASE_URL : '/';
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';

  $.post(BASE + 'groups/join/' + groupId, function(res) {
    const footer = btn.closest('div');
    btn.outerHTML = `
      <a href="#" class="g-btn g-btn-member load-page"
         data-url="${BASE}groups/feed/${groupId}">
        <i class="fa fa-sign-in"></i> Open
      </a>`;
    footer.querySelector('.load-page').addEventListener('click', function(e) {
      e.preventDefault();
      loadPage(this.dataset.url);
    });
  });
}
</script>