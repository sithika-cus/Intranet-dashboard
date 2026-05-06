<?php /* app/Views/socket_test.php */ ?>

<style id="wall-style">
:root {
  --w-ink:     #0f1117;
  --w-ink2:    #2b2f3a;
  --w-ink3:    #6b7280;
  --w-paper:   #f9f7f4;
  --w-surface: #ffffff;
  --w-accent:  #c8522a;
  --w-border:  #e5e1db;
}
#wall-page {
  display: grid;
  grid-template-columns: 240px 1fr 220px;
  gap: 20px;
  padding: 20px;
  align-items: start;
  font-family: 'Source Sans Pro', sans-serif;
  color: var(--w-ink);
}
.wcard {
  background: var(--w-surface);
  border: 1px solid var(--w-border);
  border-radius: 8px;
  overflow: hidden;
  margin-bottom: 18px;
}
.wcard-header {
  padding: 12px 18px;
  border-bottom: 1px solid var(--w-border);
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--w-ink3);
}
.wcard-body { padding: 18px; }
.w-profile-cover {
  height: 75px;
  background: linear-gradient(135deg, #0f1117 0%, #2b2f3a 60%, #3d1a0f 100%);
}
.w-profile-avatar-wrap {
  display: flex; justify-content: center;
  margin-top: -30px; margin-bottom: 10px;
  position: relative; z-index: 1;
}
.w-profile-avatar {
  width: 60px; height: 60px; border-radius: 50%;
  border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.15);
}
.w-profile-name { font-size: 1rem; font-weight: 700; text-align: center; color: var(--w-ink); }
.w-profile-role { font-size: 0.78rem; color: var(--w-ink3); text-align: center; margin-bottom: 4px; }
.w-profile-stats {
  display: grid; grid-template-columns: repeat(3,1fr);
  border-top: 1px solid var(--w-border);
  background: var(--w-border); gap: 1px; margin-top: 12px;
}
.w-stat-block { background: var(--w-surface); padding: 12px 6px; text-align: center; }
.w-stat-num   { display: block; font-size: 1.05rem; font-weight: 700; color: var(--w-ink); }
.w-stat-label { font-size: 0.65rem; color: var(--w-ink3); text-transform: uppercase; letter-spacing: 0.05em; }
.w-about-row {
  display: flex; align-items: flex-start; gap: 10px;
  padding: 10px 0; border-bottom: 1px solid var(--w-border);
}
.w-about-row:last-child { border-bottom: none; padding-bottom: 0; }
.w-about-icon {
  width: 28px; height: 28px; border-radius: 6px;
  background: var(--w-paper); display: flex; align-items: center;
  justify-content: center; color: var(--w-accent); font-size: 0.75rem; flex-shrink: 0;
}
.w-about-label { font-size: 0.7rem; color: var(--w-ink3); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px; }
.w-about-value { font-size: 0.83rem; color: var(--w-ink); }
.w-skill-tag {
  display: inline-block; font-size: 0.7rem; font-weight: 600;
  padding: 2px 9px; border-radius: 20px;
  background: var(--w-paper); border: 1px solid var(--w-border);
  color: var(--w-ink2); margin: 2px 2px 0 0;
}
.w-post-input-wrap { display: flex; gap: 10px; align-items: flex-start; margin-bottom: 10px; }
.w-post-input-avatar { width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0; }
.w-post-textarea {
  flex: 1; border: 1px solid var(--w-border); border-radius: 8px;
  padding: 10px 12px; font-size: 0.88rem; resize: none;
  outline: none; transition: border-color 0.2s;
  background: var(--w-paper); font-family: inherit; color: var(--w-ink);
}
.w-post-textarea:focus { border-color: var(--w-accent); background: #fff; }
.w-post-actions { display: flex; justify-content: flex-end; gap: 8px; }
.wbtn {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 16px; border-radius: 7px;
  font-size: 0.82rem; font-weight: 600;
  cursor: pointer; border: none; transition: all 0.18s;
}
.wbtn-primary { background: var(--w-accent); color: #fff; }
.wbtn-primary:hover { background: #a84020; }
.wbtn-ghost { background: transparent; color: var(--w-ink3); border: 1px solid var(--w-border); }
.wbtn-ghost:hover { border-color: var(--w-accent); color: var(--w-accent); }
.w-post-card { margin-bottom: 16px; animation: wFadeUp 0.3s ease forwards; }
@keyframes wFadeUp {
  from { opacity: 0; transform: translateY(8px); }
  to   { opacity: 1; transform: translateY(0); }
}
.w-post-meta { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
.w-post-avatar { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; flex-shrink: 0; }
.w-post-author { font-size: 0.86rem; font-weight: 700; color: var(--w-ink); }
.w-post-time   { font-size: 0.73rem; color: var(--w-ink3); }
.w-post-content {
  font-size: 0.88rem; line-height: 1.65;
  color: var(--w-ink2); margin-bottom: 12px; word-break: break-word;
}
.w-post-image {
  width: 100%; border-radius: 8px; margin-bottom: 12px;
  max-height: 280px; object-fit: cover; display: block;
}
.w-post-footer {
  display: flex; gap: 4px;
  border-top: 1px solid var(--w-border); padding-top: 10px;
}
.w-post-action-btn {
  display: inline-flex; align-items: center; gap: 5px;
  font-size: 0.78rem; font-weight: 500; color: var(--w-ink3);
  padding: 5px 10px; border-radius: 6px;
  border: none; background: transparent; cursor: pointer; transition: all 0.15s;
}
.w-post-action-btn:hover { background: var(--w-paper); color: var(--w-accent); }
.w-post-action-btn.liked { color: #e74c3c; }
.w-post-action-btn.liked i { font-weight: 900; }
.w-del-btn {
  margin-left: auto; background: transparent; border: none;
  color: #ccc; cursor: pointer; padding: 4px 8px;
  border-radius: 5px; transition: all 0.15s; line-height: 1;
}
.w-del-btn:hover { color: #d94f2a; background: #fef2ef; }
.w-news-item { padding: 12px 0; border-bottom: 1px solid var(--w-border); }
.w-news-item:first-child { padding-top: 0; }
.w-news-item:last-child  { border-bottom: none; padding-bottom: 0; }
.w-news-img   { width: 100%; height: 90px; object-fit: cover; border-radius: 6px; margin-bottom: 8px; display: block; }
.w-news-title { font-size: 0.82rem; font-weight: 600; color: var(--w-ink); margin-bottom: 3px; }
.w-news-blurb { font-size: 0.75rem; color: var(--w-ink3); line-height: 1.5; }
.w-trending-tag {
  display: flex; justify-content: space-between; align-items: center;
  padding: 8px 0; border-bottom: 1px solid var(--w-border); font-size: 0.82rem;
}
.w-trending-tag:last-child { border-bottom: none; }
.w-trending-tag-name  { font-weight: 600; color: var(--w-ink); }
.w-trending-tag-count { font-size: 0.73rem; color: var(--w-ink3); }
.w-comments-section {
  margin-top: 12px;
  border-top: 1px solid var(--w-border);
  padding-top: 10px;
}
.w-comment-item { display: flex; gap: 8px; margin-bottom: 10px; align-items: flex-start; }
.w-comment-avatar { width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0; }
.w-comment-bubble {
  background: var(--w-paper); border: 1px solid var(--w-border);
  border-radius: 12px; padding: 7px 12px; flex: 1;
}
.w-comment-author { font-size: 0.78rem; font-weight: 700; color: var(--w-ink); margin-bottom: 2px; }
.w-comment-text  { font-size: 0.83rem; color: var(--w-ink2); line-height: 1.5; }
.w-comment-time  { font-size: 0.7rem; color: var(--w-ink3); margin-top: 3px; }
.w-comment-del {
  background: none; border: none; color: #ccc;
  cursor: pointer; font-size: 0.7rem; padding: 2px 4px; border-radius: 4px;
}
.w-comment-del:hover { color: #e74c3c; }
.w-comment-input-wrap { display: flex; gap: 8px; margin-top: 8px; align-items: center; }
.w-comment-input {
  flex: 1; border: 1px solid var(--w-border); border-radius: 20px;
  padding: 7px 14px; font-size: 0.85rem; outline: none;
  background: var(--w-paper); font-family: inherit; transition: border-color 0.2s;
}
.w-comment-input:focus { border-color: var(--w-accent); background: #fff; }
.w-comment-submit {
  background: var(--w-accent); color: #fff; border: none;
  border-radius: 20px; padding: 7px 16px; font-size: 0.83rem;
  cursor: pointer; transition: background 0.18s;
}
.w-comment-submit:hover { background: #a84020; }
@media (max-width: 1100px) {
  #wall-page { grid-template-columns: 1fr; }
  #wall-left, #wall-right { display: none; }
}
.w-nav-group { border-bottom: 1px solid var(--w-border); }
.w-nav-group-title {
  display: flex; align-items: center; gap: 8px;
  padding: 10px 18px; font-size: 0.82rem; font-weight: 700;
  color: var(--w-ink); cursor: pointer; transition: background 0.15s; user-select: none;
}
.w-nav-group-title:hover { background: var(--w-paper); color: var(--w-accent); }
.w-nav-group-title i:first-child { color: var(--w-accent); width: 16px; text-align: center; }
.w-nav-arrow { margin-left: auto !important; transition: transform 0.2s; color: var(--w-ink3) !important; }
.w-nav-group.open .w-nav-arrow { transform: rotate(180deg); }
.w-nav-group-items { display: none; background: var(--w-paper); padding: 4px 0; }
.w-nav-group.open .w-nav-group-items { display: block; }
.w-nav-item {
  display: flex; align-items: center; gap: 8px;
  padding: 7px 18px 7px 32px; font-size: 0.8rem;
  color: var(--w-ink2); text-decoration: none; transition: all 0.15s;
}
.w-nav-item:hover { background: var(--w-border); color: var(--w-accent); text-decoration: none; }
.w-nav-item i { font-size: 0.75rem; color: var(--w-ink3); width: 14px; text-align: center; }
.w-nav-item.active { color: var(--w-accent); font-weight: 600; }
.w-nav-item.active i { color: var(--w-accent); }
.w-nav-subgroup { border-top: 1px solid var(--w-border); border-bottom: 1px solid var(--w-border); margin: 2px 0; }
.w-nav-subgroup-title {
  display: flex; align-items: center; gap: 8px;
  padding: 7px 18px 7px 32px; font-size: 0.8rem; font-weight: 600;
  color: var(--w-ink2); cursor: pointer; transition: background 0.15s; user-select: none;
}
.w-nav-subgroup-title:hover { background: var(--w-border); color: var(--w-accent); }
.w-nav-subgroup-title i:first-child { font-size: 0.75rem; color: var(--w-ink3); width: 14px; text-align: center; }
.w-nav-subarrow { margin-left: auto !important; transition: transform 0.2s; color: var(--w-ink3) !important; font-size: 0.75rem; }
.w-nav-subgroup.open .w-nav-subarrow { transform: rotate(180deg); }
.w-nav-subgroup-items { display: none; background: #f0ede8; padding: 2px 0; }
.w-nav-subgroup.open .w-nav-subgroup-items { display: block; }
.w-nav-subgroup-items .w-nav-item { padding-left: 48px; }
.w-photo-preview-wrap {
  position: relative; margin-top: 10px; border-radius: 12px;
  overflow: hidden; border: 0.3px solid var(--w-border);
  background: var(--w-paper); display: none; padding: 12px; transition: all 0.2s;
}
.w-photo-preview-wrap.has-file {
  display: inline-flex; align-items: center; gap: 12px;
  animation: wFadeUp 0.25s ease forwards; max-width: 300px;
  border-color: var(--w-accent); background: #fef5f2;
  box-shadow: 0 2px 12px rgba(200,82,42,0.1);
}
.w-photo-preview-inner {
  position: relative; width: 68px; height: 68px; flex-shrink: 0;
  border-radius: 8px; overflow: visible; border: none; background: transparent;
}
#preview-img { width: 68px; height: 68px; object-fit: cover; display: block; border-radius: 8px; margin: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
.w-preview-remove {
  position: absolute; top: -7px; right: -7px; width: 20px; height: 20px;
  border-radius: 50%; background: #0f1117; border: 2px solid #fff;
  color: #fff; font-size: 0.62rem; font-weight: 700; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: background 0.15s, transform 0.15s; z-index: 2;
  box-shadow: 0 1px 4px rgba(0,0,0,0.3);
}
.w-preview-remove:hover { background: #e74c3c; border-color: #fff; transform: scale(1.15); }
.w-preview-filename {
  flex: 1; padding: 0; font-size: 0.78rem; color: var(--w-ink2);
  background: transparent; border: none;
  display: flex; flex-direction: column; gap: 4px; min-width: 0;
}
.w-preview-filename i { color: var(--w-accent); font-size: 0.85rem; }
#preview-name-text {
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
  font-size: 0.82rem; font-weight: 600; color: var(--w-ink);
}
.w-preview-type-label { font-size: 0.7rem; color: var(--w-ink3); text-transform: uppercase; letter-spacing: 0.04em; font-weight: 500; }
#photo-btn.has-photo { border-color: var(--w-accent); color: var(--w-accent); background: #fef2ef; box-shadow: 0 2px 8px rgba(200,82,42,0.15); }
.w-post-content {
  font-size: 0.88rem; line-height: 1.7; color: var(--w-ink2);
  margin-bottom: 4px; word-break: break-word;
  display: -webkit-box; -webkit-line-clamp: 1;
  -webkit-box-orient: vertical; overflow: hidden;
}
.w-post-content.expanded { display: block; -webkit-line-clamp: unset; overflow: visible; }
.w-read-more-btn {
  background: none; border: none; padding: 0; margin-top: 2px; margin-bottom: 10px;
  font-size: 0.82rem; font-weight: 700; color: var(--w-accent);
  cursor: pointer; display: none; letter-spacing: 0.01em; transition: opacity 0.15s;
}
.w-read-more-btn:hover { opacity: 0.75; }
.w-read-more-btn.visible { display: inline-block; }

/* ── Load more / end of feed ── */
.w-feed-footer { text-align: center; padding: 24px 0 40px; }
.w-load-more-btn {
  background: #fff; border: 1.5px solid var(--w-accent);
  color: var(--w-accent); padding: 10px 32px; border-radius: 8px;
  font-size: 0.88rem; font-weight: 600; cursor: pointer; transition: all 0.18s;
}
.w-load-more-btn:hover { background: #fef2ef; }
.w-load-more-btn:disabled { opacity: 0.6; cursor: not-allowed; }
.w-end-msg {
  display: inline-flex; flex-direction: column;
  align-items: center; gap: 8px; color: var(--w-ink3);
}
.w-end-msg i { font-size: 1.5rem; color: #c8e6c9; }
.w-end-msg-title { font-size: 0.88rem; font-weight: 600; color: var(--w-ink2); }
.w-end-msg-sub { font-size: 0.78rem; }

/* ── Replies ── */
.w-replies-wrap {
  margin-left: 36px;
  margin-top: 6px;
}
.w-view-replies-btn {
  background: none; border: none; padding: 0;
  font-size: 0.78rem; font-weight: 700;
  color: var(--w-accent, #c8522a);
  cursor: pointer; margin-left: 36px;
  margin-bottom: 4px; transition: opacity 0.15s;
}
.w-view-replies-btn:hover { opacity: 0.75; }
.w-reply-btn {
  background: none; border: none; padding: 0;
  font-size: 0.75rem; font-weight: 700;
  color: #6b7280; cursor: pointer;
  margin-left: 8px; transition: color 0.15s;
}
.w-reply-btn:hover { color: #c8522a; }
.w-reply-input-wrap {
  display: flex; gap: 8px; margin-top: 6px;
  margin-left: 36px; align-items: center;
}
.w-reply-input {
  flex: 1; border: 1px solid #e5e1db; border-radius: 20px;
  padding: 6px 12px; font-size: 0.82rem; outline: none;
  background: #f9f7f4; font-family: inherit; transition: border-color 0.2s;
}
.w-reply-input:focus { border-color: #c8522a; background: #fff; }
.w-reply-submit {
  background: #c8522a; color: #fff; border: none;
  border-radius: 20px; padding: 6px 14px; font-size: 0.8rem;
  cursor: pointer; transition: background 0.18s;
}
.w-reply-submit:hover { background: #a84020; }
.w-comment-item.is-reply {
  margin-left: 0;
}
.w-comment-item.is-reply .w-comment-bubble {
  background: #f0ede8;
}
</style>

<div id="wall-page">

  <!-- LEFT -->
  <div id="wall-left">
    <div class="wcard">
      <div class="w-profile-cover"></div>
      <div class="wcard-body" style="padding-top:0">
        <div class="w-profile-avatar-wrap">
          <img class="w-profile-avatar" src="https://randomuser.me/api/portraits/men/44.jpg" alt="">
        </div>
        <div class="w-profile-name">Staff Wall</div>
        <div class="w-profile-role">Sri Lanka Customs</div>
      </div>
      <div class="w-profile-stats">
        <div class="w-stat-block"><span class="w-stat-num" id="wall-count">—</span><span class="w-stat-label">Posts</span></div>
        <div class="w-stat-block"><span class="w-stat-num">—</span><span class="w-stat-label">Online</span></div>
        <div class="w-stat-block"><span class="w-stat-num">—</span><span class="w-stat-label">Likes</span></div>
      </div>
    </div>

    <div class="wcard">
      <div class="wcard-header">Navigation</div>
      <div class="wcard-body" style="padding: 8px 0;">
        <div class="w-nav-group" style="border-bottom: 1px solid var(--w-border);">
          <div class="w-nav-group-title load-page" data-url="<?= base_url('wall/page') ?>" style="cursor:pointer;">
            <i class="fa fa-tachometer"></i> Dashboard
          </div>
        </div>
        <div class="w-nav-group" style="border-bottom: 1px solid var(--w-border);">
          <div class="w-nav-group-title load-page" data-url="<?= base_url('groups') ?>" style="cursor:pointer;">
            <i class="fa fa-users" style="color:var(--w-accent);width:16px;text-align:center;"></i> Groups
          </div>
        </div>
        <?php if(session()->get('role') === 'admin'): ?>
<div class="w-nav-group" style="border-bottom: 1px solid var(--w-border);">
  <div class="w-nav-group-title load-page"
       data-url="<?= base_url('action-permissions') ?>"
       style="cursor:pointer;">
    <i class="fa fa-shield" style="color:var(--w-accent);width:16px;text-align:center;"></i>
    User Permissions
  </div>
</div>
<?php endif; ?>
        <div class="w-nav-group">
          <div class="w-nav-group-title">
            <i class="fa fa-book"></i> Publications
            <i class="fa fa-angle-down w-nav-arrow"></i>
          </div>
          <div class="w-nav-group-items">
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('publications/departmentalOrders') ?>"><i class="fa fa-file-text-o"></i> Departmental Orders</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('publications/ncCommittee') ?>"><i class="fa fa-file-text-o"></i> NC Committee Decisions</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('publications/vcDecisions') ?>"><i class="fa fa-file-text-o"></i> Valuation Committee Decisions</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('publications/cOrdinance') ?>"><i class="fa fa-file-text-o"></i> Customs Ordinance</a>
            <div class="w-nav-subgroup">
              <div class="w-nav-subgroup-title">
                <i class="fa fa-file-text-o"></i> Legal Uploads
                <i class="fa fa-angle-down w-nav-subarrow"></i>
              </div>
              <div class="w-nav-subgroup-items">
                <a href="#" class="w-nav-item load-page" data-url="<?= base_url('publications/lUploads') ?>"><i class="fa fa-gavel"></i> Judgements</a>
                <a href="#" class="w-nav-item load-page" data-url="<?= base_url('publications/aGadvices') ?>"><i class="fa fa-file-text-o"></i> AG Advices</a>
              </div>
            </div>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('publications/cUploads') ?>"><i class="fa fa-file-text-o"></i> Common Uploads</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('publications/cDetections') ?>"><i class="fa fa-file-text-o"></i> Customs Detections</a>
          </div>
        </div>
        <div class="w-nav-group">
          <div class="w-nav-group-title">
            <i class="fa fa-cubes"></i> Commodity Classification
            <i class="fa fa-angle-down w-nav-arrow"></i>
          </div>
          <div class="w-nav-group-items">
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('cclassification/advanceRuiling') ?>"><i class="fa fa-file-text-o"></i> Advance Ruling</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('cclassification/internalRuiling') ?>"><i class="fa fa-file-text-o"></i> Internal Ruling</a>
          </div>
        </div>
        <div class="w-nav-group">
          <div class="w-nav-group-title">
            <i class="fa fa-users"></i> Rosters
            <i class="fa fa-angle-down w-nav-arrow"></i>
          </div>
          <div class="w-nav-group-items">
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('rosters/wRoasters') ?>"><i class="fa fa-file-text-o"></i> Warehouse (ASC)</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('rosters/aRosters') ?>"><i class="fa fa-file-text-o"></i> SO Airport/Import/Export</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('rosters/ascRosters') ?>"><i class="fa fa-file-text-o"></i> SC Airport/Import/Export</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('rosters/aTransfer') ?>"><i class="fa fa-file-text-o"></i> Appraiser</a>
          </div>
        </div>
        <div class="w-nav-group">
          <div class="w-nav-group-title">
            <i class="fa fa-exchange"></i> Transfers
            <i class="fa fa-angle-down w-nav-arrow"></i>
          </div>
          <div class="w-nav-group-items">
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('transfers/ddcTransfers') ?>"><i class="fa fa-file-text-o"></i> DDC Transfers</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('transfers/scTransfers') ?>"><i class="fa fa-file-text-o"></i> SC Transfers</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('transfers/apTransfers') ?>"><i class="fa fa-file-text-o"></i> Appraiser Transfers</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('transfers/ascTransfers') ?>"><i class="fa fa-file-text-o"></i> ASC & DSC Transfers</a>
          </div>
        </div>
        <div class="w-nav-group">
          <div class="w-nav-group-title">
            <i class="fa fa-graduation-cap"></i> Training Programs
            <i class="fa fa-angle-down w-nav-arrow"></i>
          </div>
          <div class="w-nav-group-items">
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('trainings/fTrainings') ?>"><i class="fa fa-file-text-o"></i> Foreign Training</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('trainings/') ?>"><i class="fa fa-file-text-o"></i> Local Training</a>
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('trainings/tMaterials') ?>"><i class="fa fa-file-text-o"></i> Training Materials</a>
          </div>
        </div>
        <div class="w-nav-group">
          <div class="w-nav-group-title">
            <i class="fa fa-file"></i> Common Templates
            <i class="fa fa-angle-down w-nav-arrow"></i>
          </div>
          <div class="w-nav-group-items">
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('comtemplates/cTemplates') ?>"><i class="fa fa-file-text-o"></i> Templates</a>
          </div>
        </div>
        <div class="w-nav-group" style="border-bottom:none;">
          <div class="w-nav-group-title">
            <i class="fa fa-bell"></i> Notifications
            <i class="fa fa-angle-down w-nav-arrow"></i>
          </div>
          <div class="w-nav-group-items">
            <a href="#" class="w-nav-item load-page" data-url="<?= base_url('comtemplates/iNotifications') ?>"><i class="fa fa-file-text-o"></i> Intranet Notifications</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CENTER -->
  <div id="wall-center">
    <div class="wcard" style="margin-bottom:18px;">
      <div class="wcard-body">
        <div class="w-post-input-wrap">
          <img class="w-post-input-avatar" src="https://randomuser.me/api/portraits/men/44.jpg" alt="">
          <textarea id="wall-content" class="w-post-textarea" rows="3" placeholder="What's on your mind?"></textarea>
        </div>
        <div class="w-photo-preview-wrap" id="photo-preview-wrap">
          <div class="w-photo-preview-inner">
            <img id="preview-img" src="" alt="Preview">
            <button class="w-preview-remove" id="preview-remove-btn" title="Remove">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="w-preview-filename" id="preview-filename">
            <i class="fa fa-image"></i>
            <span id="preview-name-text"></span>
            <span class="w-preview-type-label" id="preview-type-label"></span>
          </div>
        </div>
        <div class="w-post-actions">
          <input type="file" id="wall-image" accept="image/*,application/pdf" style="display:none">
          <button class="wbtn wbtn-ghost" id="photo-btn">
            <i class="fa fa-image"></i> Photo
          </button>
          <button id="wall-post-btn" class="wbtn wbtn-primary">
            <i class="fa fa-paper-plane"></i> Publish
          </button>
        </div>
      </div>
    </div>
    <div id="wall-posts"></div>
  </div>

  <!-- RIGHT -->
  <div id="wall-right">
    <div class="wcard" style="margin-bottom:18px;">
      <div class="wcard-header">Latest News</div>
      <div class="wcard-body">
        <div class="w-news-item">
          <img class="w-news-img" src="https://picsum.photos/seed/customs1/400/200" alt="">
          <div class="w-news-title">Trade Facilitation Updates</div>
          <div class="w-news-blurb">New procedures for express cargo clearance now in effect.</div>
        </div>
        <div class="w-news-item">
          <img class="w-news-img" src="https://picsum.photos/seed/customs2/400/200" alt="">
          <div class="w-news-title">System Maintenance Notice</div>
          <div class="w-news-blurb">ASYCUDA scheduled downtime this Saturday 2–4 AM.</div>
        </div>
      </div>
    </div>
    <div class="wcard">
      <div class="wcard-header">Trending</div>
      <div class="wcard-body" style="padding-top:8px; padding-bottom:8px;">
        <div class="w-trending-tag"><span class="w-trending-tag-name">#TradePolicy</span><span class="w-trending-tag-count">142 posts</span></div>
        <div class="w-trending-tag"><span class="w-trending-tag-name">#Compliance</span><span class="w-trending-tag-count">98 posts</span></div>
        <div class="w-trending-tag"><span class="w-trending-tag-name">#ASYCUDA</span><span class="w-trending-tag-count">76 posts</span></div>
        <div class="w-trending-tag"><span class="w-trending-tag-name">#Customs</span><span class="w-trending-tag-count">61 posts</span></div>
      </div>
    </div>
  </div>

</div>

<script>
function initWallApp() {
  const BASE   = typeof BASE_URL !== 'undefined' ? BASE_URL : '/';
  let active   = true;
  let wOffset  = 0;
  const WLIMIT = 15;
  let wLoading = false;
  let wHasMore = true;
  let wTotal   = 0;

  const avatarIds = [10,12,18,22,28,32,36,39,41,43,46,52,56,62,68,72];
  function rand(arr) { return arr[Math.floor(Math.random() * arr.length)]; }
  function randAvatar() { return `https://randomuser.me/api/portraits/men/${rand(avatarIds)}.jpg`; }

  // ── Read more ────────────────────────────────────────
  function checkReadMore(card) {
    const contentEl   = card.querySelector('.w-post-content');
    const readMoreBtn = card.querySelector('.w-read-more-btn');
    if (!contentEl || !readMoreBtn) return;
    if (contentEl.scrollHeight > contentEl.clientHeight) {
      readMoreBtn.classList.add('visible');
    } else {
      readMoreBtn.classList.remove('visible');
    }
  }

  // ── Build post card ──────────────────────────────────
  function buildCard(p) {
    const div = document.createElement('div');
    div.className = 'wcard w-post-card';
    if (p.id) div.dataset.postId = p.id;
    div.innerHTML = `
      <div class="wcard-body">
        <div class="w-post-meta">
          <img class="w-post-avatar" src="${randAvatar()}" alt="">
          <div>
            <div class="w-post-author">Staff Member</div>
            <div class="w-post-time"></div>
          </div>
          ${p.id ? `<button class="w-del-btn" data-post-id="${p.id}" title="Delete"><i class="fa fa-trash"></i></button>` : ''}
        </div>
        <div class="w-post-content"></div>
        <button class="w-read-more-btn">... See more</button>
        ${p.attachments && p.attachments.length ?
          p.attachments.map(a => {
            if (a.mime_type.startsWith('image')) return `<img class="w-post-image" src="/${a.file_path}" alt="">`;
            if (a.mime_type === 'application/pdf') return `<iframe src="/${a.file_path}" style="width:100%;height:300px;"></iframe>`;
            return `<a href="/${a.file_path}" target="_blank">Download file</a>`;
          }).join('') : ''}
        <div class="w-post-footer">
          <button class="w-post-action-btn w-like-btn" data-post-id="${p.id || ''}">
            <i class="fa fa-heart-o"></i>
            <span class="w-like-count">${p.likes || 0}</span>
          </button>
          <button class="w-post-action-btn w-comment-toggle-btn" data-post-id="${p.id || ''}">
            <i class="fa fa-comment-o"></i> Comment
          </button>
          <button class="w-post-action-btn w-share-btn">
            <i class="fa fa-share"></i> Share
          </button>
        </div>
        <div class="w-comments-section">
          <div class="w-comments-list" style="display:none;"></div>
          <div class="w-comment-input-wrap">
            <img class="w-comment-avatar" src="https://randomuser.me/api/portraits/men/44.jpg" alt="">
            <input type="text" class="w-comment-input" placeholder="Write a comment...">
            <button class="w-comment-submit">Post</button>
          </div>
        </div>
      </div>`;
    div.querySelector('.w-post-content').textContent = p.content;
    div.querySelector('.w-post-time').textContent    = p.created_at || 'Just now';
    return div;
  }

  // ── Build comment with reply support ─────────────────
  function buildComment(c, depth = 0) {
    const div = document.createElement('div');
    div.className = 'w-comment-item' + (depth > 0 ? ' is-reply' : '');
    if (c.id) div.dataset.commentId = c.id;
    div.dataset.depth = depth;

    const replyCount = parseInt(c.reply_count || 0);
    const canReply   = depth < 2;

    div.innerHTML = `
      <img class="w-comment-avatar" src="${randAvatar()}" alt="">
      <div style="flex:1;">
        <div class="w-comment-bubble">
          <div class="w-comment-author">Staff Member</div>
          <div class="w-comment-text"></div>
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <div class="w-comment-time">${c.created_at || 'Just now'}</div>
            <div style="display:flex;align-items:center;gap:4px;">
              ${canReply ? `<button class="w-reply-btn" data-comment-id="${c.id}"><i class="fa fa-reply"></i> Reply</button>` : ''}
              ${c.id ? `<button class="w-comment-del" data-comment-id="${c.id}"><i class="fa fa-trash"></i></button>` : ''}
            </div>
          </div>
        </div>
        ${replyCount > 0 ? `
          <button class="w-view-replies-btn" data-comment-id="${c.id}" data-loaded="0">
            <i class="fa fa-comment-o"></i> View ${replyCount} ${replyCount === 1 ? 'reply' : 'replies'}
          </button>
        ` : ''}
        <div class="w-replies-wrap" id="replies-${c.id}" style="display:none;"></div>
        <div class="w-reply-input-wrap" id="reply-input-${c.id}" style="display:none;">
          <img class="w-comment-avatar" src="https://randomuser.me/api/portraits/men/44.jpg" alt="">
          <input type="text" class="w-reply-input" placeholder="Write a reply...">
          <button class="w-reply-submit" data-comment-id="${c.id}" data-depth="${depth}">Reply</button>
        </div>
      </div>`;

    div.querySelector('.w-comment-text').textContent = c.content;
    return div;
  }

  // ── Load comments ────────────────────────────────────
  function loadComments(postCard) {
    const postId = postCard.dataset.postId;
    if (!postId) return;
    $.get(BASE + 'wall/comments', { postId }, function(comments) {
        if (!active) return;
        const list = postCard.querySelector('.w-comments-list');
        if (!list) return;
        list.innerHTML = '';
        comments.forEach(c => list.appendChild(buildComment(c, 0))); // ← depth=0
    });
}

  // ── Feed footer (end message only) ──────────────────
  function renderFeedFooter() {
    const existing = document.getElementById('wall-feed-footer');
    if (existing) existing.remove();

    if (!wHasMore) {
      const footer = document.createElement('div');
      footer.id = 'wall-feed-footer';
      footer.className = 'w-feed-footer';
      footer.innerHTML = `
        <div class="w-end-msg">
          <div style="width:48px;height:2px;background:linear-gradient(90deg,transparent,#e5e1db,transparent);margin-bottom:4px;"></div>
          <i class="fa fa-check-circle"></i>
          <span class="w-end-msg-title">You're all caught up!</span>
          <span class="w-end-msg-sub">No more posts to show</span>
        </div>`;
      document.getElementById('wall-posts').appendChild(footer);
    }
  }

  // ── Loading spinner ──────────────────────────────────
  function renderLoadingSpinner(show) {
    const existing = document.getElementById('wall-loading-spinner');
    if (show) {
      if (existing) return;
      const spinner = document.createElement('div');
      spinner.id = 'wall-loading-spinner';
      spinner.style.cssText = 'text-align:center;padding:20px 0;';
      spinner.innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:1.5rem;color:#c8522a;"></i>';
      document.getElementById('wall-posts').appendChild(spinner);
    } else {
      if (existing) existing.remove();
    }
  }

  // ── Fetch posts ──────────────────────────────────────
  function fetchPosts(append = false) {
    if (wLoading || !active) return;
    wLoading = true;

    renderLoadingSpinner(true);

    $.get(BASE + 'wall/posts', { offset: wOffset }, function(res) {
      if (!active) return;

      renderLoadingSpinner(false);

      const feed   = document.getElementById('wall-posts');
      const footer = document.getElementById('wall-feed-footer');
      if (footer) footer.remove();

      if (!append) feed.innerHTML = '';

      if (res.posts.length === 0 && !append) {
        feed.innerHTML = `
          <div class="wcard">
            <div class="wcard-body" style="text-align:center;padding:40px 20px;color:#6b7280;">
              <i class="fa fa-newspaper-o" style="font-size:2.5rem;color:#e5e1db;display:block;margin-bottom:12px;"></i>
              <div style="font-size:0.95rem;font-weight:600;color:#2b2f3a;">No posts yet</div>
              <div style="font-size:0.82rem;margin-top:4px;">Be the first to share something!</div>
            </div>
          </div>`;
        wLoading = false;
        wHasMore = false;
        renderFeedFooter();
        return;
      }

      res.posts.forEach(p => {
        if (!document.querySelector(`[data-post-id="${p.id}"]`)) {
          const card = buildCard(p);
          feed.appendChild(card);
          setTimeout(() => checkReadMore(card), 50);
        }
      });

      wOffset  = res.offset + res.posts.length;
      wHasMore = res.hasMore;
      wTotal   = res.total;
      wLoading = false;

      const countEl = document.getElementById('wall-count');
      if (countEl) countEl.textContent = wTotal;

      renderFeedFooter();
    });
  }

  // ── Infinite scroll ──────────────────────────────────
  function setupInfiniteScroll() {
    const scrollEl = document.getElementById('content-area')
                  || document.getElementById('main-content')
                  || window;

    function onScroll() {
      if (!wHasMore || wLoading || !active) return;

      let scrollTop, scrollHeight, clientHeight;
      if (scrollEl === window) {
        scrollTop    = window.scrollY || document.documentElement.scrollTop;
        scrollHeight = document.documentElement.scrollHeight;
        clientHeight = window.innerHeight;
      } else {
        scrollTop    = scrollEl.scrollTop;
        scrollHeight = scrollEl.scrollHeight;
        clientHeight = scrollEl.clientHeight;
      }

      if (scrollTop + clientHeight >= scrollHeight - 300) {
        fetchPosts(true);
      }
    }

    scrollEl.addEventListener('scroll', onScroll);
    if (scrollEl !== window) {
      window.addEventListener('scroll', onScroll);
    }

    $('#content-area').one('load-page-change', function() {
      scrollEl.removeEventListener('scroll', onScroll);
      window.removeEventListener('scroll', onScroll);
    });
  }

  // ── Socket ───────────────────────────────────────────
  window.wallSocket = null;
  try {
    window.wallSocket = io('http://intranet.local:3000');
    window.wallSocket.on('new_post', () => {
      if (!active) return;
      wOffset = 0; wHasMore = true;
      fetchPosts(false);
    });
  } catch(e) {}

  const fallbackTimer = setTimeout(() => {
    if (!active) return;
    const feed = document.getElementById('wall-posts');
    if (feed && !feed.children.length) fetchPosts(false);
  }, 2500);

  // Initial load
  fetchPosts(false);
  setupInfiniteScroll();

  $('#content-area').one('load-page-change', function() {
    active = false;
    clearTimeout(fallbackTimer);
    if (window.wallSocket) { window.wallSocket.disconnect(); window.wallSocket = null; }
  });

  // ── Photo picker ─────────────────────────────────────
  document.getElementById('photo-btn').addEventListener('click', function() {
    document.getElementById('wall-image').click();
  });

  let selectedImage = null;

  function clearPreview() {
    selectedImage = null;
    document.getElementById('wall-image').value = '';
    const img = document.getElementById('preview-img');
    if (img) { img.src = ''; img.style.display = 'none'; }
    const nameEl = document.getElementById('preview-name-text');
    if (nameEl) nameEl.textContent = '';
    const wrap = document.getElementById('photo-preview-wrap');
    if (wrap) wrap.classList.remove('has-file');
    const btn = document.getElementById('photo-btn');
    if (btn) btn.classList.remove('has-photo');
  }

  document.getElementById('preview-remove-btn').addEventListener('click', clearPreview);

  document.getElementById('wall-image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    selectedImage = file;
    const wrap      = document.getElementById('photo-preview-wrap');
    const nameEl    = document.getElementById('preview-name-text');
    const typeLabel = document.getElementById('preview-type-label');
    const img       = document.getElementById('preview-img');
    if (nameEl) nameEl.textContent = file.name;
    if (typeLabel) typeLabel.textContent = file.type.startsWith('image/') ? 'Image' : 'PDF document';
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(ev) {
        if (!img) return;
        img.src = ev.target.result;
        img.style.display = 'block';
        if (wrap) wrap.classList.add('has-file');
        const btn = document.getElementById('photo-btn');
        if (btn) btn.classList.add('has-photo');
      };
      reader.readAsDataURL(file);
    } else {
      if (img) img.style.display = 'none';
      if (wrap) wrap.classList.add('has-file');
      const btn = document.getElementById('photo-btn');
      if (btn) btn.classList.add('has-photo');
    }
  });

  // ── Publish ──────────────────────────────────────────
  document.getElementById('wall-post-btn').addEventListener('click', function() {
    if (!active) return;
    const ta      = document.getElementById('wall-content');
    const content = ta.value.trim();
    if (!content && !selectedImage) { ta.focus(); return; }

    const formData = new FormData();
    formData.append('content', content);
    formData.append('user_id', 1);
    if (selectedImage) formData.append('image', selectedImage);

    fetch(BASE + 'wall/create', { method: 'POST', body: formData })
      .then(res => res.json())
      .then(res => {
        const feed = document.getElementById('wall-posts');
        const card = buildCard(res);
        if (feed.firstChild) {
          feed.insertBefore(card, feed.firstChild);
        } else {
          feed.appendChild(card);
        }
        setTimeout(() => checkReadMore(card), 50);
        ta.value = '';
        clearPreview();
        wOffset++;
        wTotal++;
        const countEl = document.getElementById('wall-count');
        if (countEl) countEl.textContent = wTotal;
      });
  });

  // ── Feed click handler ───────────────────────────────
  document.getElementById('wall-posts').addEventListener('click', function(e) {
    if (!active) return;

    // ── Read more ──────────────────────────────────────
    const readMoreBtn = e.target.closest('.w-read-more-btn');
    if (readMoreBtn) {
      const contentEl  = readMoreBtn.previousElementSibling;
      const isExpanded = contentEl.classList.contains('expanded');
      contentEl.classList.toggle('expanded');
      readMoreBtn.textContent = isExpanded ? '... See more' : 'less';
      return;
    }

    // ── Delete post ────────────────────────────────────
    const delBtn = e.target.closest('.w-del-btn');
    if (delBtn) {
      if (!confirm('Delete this post?')) return;
      const postCard = delBtn.closest('.w-post-card');
      postCard.style.transition = 'opacity 0.25s, transform 0.25s';
      postCard.style.opacity    = '0';
      postCard.style.transform  = 'scale(0.97)';
      setTimeout(() => postCard.remove(), 260);
      $.post(BASE + 'wall/delete', { id: delBtn.dataset.postId });
      wOffset = Math.max(0, wOffset - 1);
      wTotal  = Math.max(0, wTotal - 1);
      const countEl = document.getElementById('wall-count');
      if (countEl) countEl.textContent = wTotal;
      return;
    }

    // ── Like ───────────────────────────────────────────
    const likeBtn = e.target.closest('.w-like-btn');
    if (likeBtn) {
      const postId  = likeBtn.dataset.postId;
      const countEl = likeBtn.querySelector('.w-like-count');
      const icon    = likeBtn.querySelector('i');
      const isLiked = likeBtn.classList.contains('liked');
      if (isLiked) {
        likeBtn.classList.remove('liked');
        icon.className = 'fa fa-heart-o';
        countEl.textContent = Math.max(0, parseInt(countEl.textContent) - 1);
      } else {
        likeBtn.classList.add('liked');
        icon.className = 'fa fa-heart';
        countEl.textContent = parseInt(countEl.textContent) + 1;
        if (postId) $.post(BASE + 'wall/like', { postId }, function(res) {
          if (res.likes !== undefined) countEl.textContent = res.likes;
        });
      }
      return;
    }

    // ── Toggle comments ────────────────────────────────
    const commentBtn = e.target.closest('.w-comment-toggle-btn');
    if (commentBtn) {
      const postCard = commentBtn.closest('.w-post-card');
      const list     = postCard.querySelector('.w-comments-list');
      if (list.style.display === 'none' || list.style.display === '') {
        list.style.display = 'block';
        loadComments(postCard);
      } else {
        list.style.display = 'none';
      }
      return;
    }

    // ── Submit comment ─────────────────────────────────
    const submitBtn = e.target.closest('.w-comment-submit');
    if (submitBtn) {
      const postCard = submitBtn.closest('.w-post-card');
      const postId   = postCard.dataset.postId;
      const input    = postCard.querySelector('.w-comment-input');
      const content  = input.value.trim();
      if (!content) { input.focus(); return; }
      $.post(BASE + 'wall/comments/add', { postId, content, user_id: 1 }, function(res) {
        if (!active) return;
        const list = postCard.querySelector('.w-comments-list');
        list.style.display = 'block';
        list.appendChild(buildComment(res, 0));
        input.value = '';
      });
      return;
    }

    // ── Delete comment ─────────────────────────────────
    const delComment = e.target.closest('.w-comment-del');
    if (delComment) {
      if (!confirm('Delete this comment?')) return;
      const commentItem = delComment.closest('.w-comment-item');
      commentItem.style.opacity    = '0';
      commentItem.style.transition = 'opacity 0.2s';
      setTimeout(() => commentItem.remove(), 220);
      $.post(BASE + 'wall/comments/delete', { commentId: delComment.dataset.commentId });
      return;
    }

    // ── View replies ───────────────────────────────────
    const viewRepliesBtn = e.target.closest('.w-view-replies-btn');
    if (viewRepliesBtn) {
      const commentId   = viewRepliesBtn.dataset.commentId;
      const loaded      = viewRepliesBtn.dataset.loaded === '1';
      const repliesWrap = document.getElementById('replies-' + commentId);

      if (loaded) {
        const isHidden = repliesWrap.style.display === 'none';
        repliesWrap.style.display = isHidden ? 'block' : 'none';
        viewRepliesBtn.innerHTML  = isHidden
          ? `<i class="fa fa-chevron-up"></i> Hide replies`
          : `<i class="fa fa-comment-o"></i> View replies`;
        return;
      }

      viewRepliesBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading...';

      $.get(BASE + 'wall/comments/replies', { commentId }, function(replies) {
        repliesWrap.innerHTML = '';
        replies.forEach(r => repliesWrap.appendChild(buildComment(r, 1)));
        repliesWrap.style.display = 'block';
        viewRepliesBtn.dataset.loaded = '1';
        viewRepliesBtn.innerHTML = `<i class="fa fa-chevron-up"></i> Hide replies`;
      });
      return;
    }

    // ── Reply button ───────────────────────────────────
    const replyBtn = e.target.closest('.w-reply-btn');
    if (replyBtn) {
      const commentId = replyBtn.dataset.commentId;
      const inputWrap = document.getElementById('reply-input-' + commentId);
      const isVisible = inputWrap.style.display !== 'none';
      inputWrap.style.display = isVisible ? 'none' : 'flex';
      if (!isVisible) inputWrap.querySelector('.w-reply-input').focus();
      return;
    }

    // ── Submit reply ───────────────────────────────────
    const replySubmit = e.target.closest('.w-reply-submit');
    if (replySubmit) {
      const parentId  = replySubmit.dataset.commentId;
      const depth     = parseInt(replySubmit.dataset.depth || 0);
      const inputWrap = document.getElementById('reply-input-' + parentId);
      const input     = inputWrap.querySelector('.w-reply-input');
      const content   = input.value.trim();
      if (!content) { input.focus(); return; }

      const postCard = replySubmit.closest('.w-post-card');
      const postId   = postCard.dataset.postId;

      $.post(BASE + 'wall/comments/add', {
        postId,
        content,
        user_id:  1,
        parentId,
      }, function(res) {
        const repliesWrap = document.getElementById('replies-' + parentId);
        repliesWrap.appendChild(buildComment(res, depth + 1));
        repliesWrap.style.display = 'block';
        input.value = '';
        inputWrap.style.display = 'none';

        // Update or create view replies button
        let viewBtn = document.querySelector(`.w-view-replies-btn[data-comment-id="${parentId}"]`);
        if (viewBtn) {
          viewBtn.dataset.loaded = '1';
          viewBtn.innerHTML = `<i class="fa fa-chevron-up"></i> Hide replies`;
        } else {
          viewBtn = document.createElement('button');
          viewBtn.className = 'w-view-replies-btn';
          viewBtn.dataset.commentId = parentId;
          viewBtn.dataset.loaded    = '1';
          viewBtn.innerHTML = `<i class="fa fa-chevron-up"></i> Hide replies`;
          repliesWrap.parentNode.insertBefore(viewBtn, repliesWrap);
        }
      });
      return;
    }

    // ── Share ──────────────────────────────────────────
    const shareBtn = e.target.closest('.w-share-btn');
    if (shareBtn) {
      const postCard = shareBtn.closest('.w-post-card');
      const postId   = postCard.dataset.postId;
      const link     = window.location.origin + '/?post=' + postId;
      navigator.clipboard.writeText(link).then(function() {
        const orig = shareBtn.innerHTML;
        shareBtn.innerHTML = '<i class="fa fa-check"></i> Copied!';
        shareBtn.style.color = '#27ae60';
        setTimeout(() => { shareBtn.innerHTML = orig; shareBtn.style.color = ''; }, 2000);
      }).catch(function() {
        const ta = document.createElement('textarea');
        ta.value = link; document.body.appendChild(ta); ta.select();
        document.execCommand('copy'); document.body.removeChild(ta);
        shareBtn.innerHTML = '<i class="fa fa-check"></i> Copied!';
        shareBtn.style.color = '#27ae60';
        setTimeout(() => { shareBtn.innerHTML = '<i class="fa fa-share"></i> Share'; shareBtn.style.color = ''; }, 2000);
      });
      return;
    }
  });

  // ── Comment / Reply enter key ────────────────────────
  document.getElementById('wall-posts').addEventListener('keydown', function(e) {
    if (!active) return;
    if (e.key === 'Enter' && !e.shiftKey) {
      const commentInput = e.target.closest('.w-comment-input');
      if (commentInput) {
        e.preventDefault();
        commentInput.closest('.w-comment-input-wrap').querySelector('.w-comment-submit').click();
        return;
      }
      const replyInput = e.target.closest('.w-reply-input');
      if (replyInput) {
        e.preventDefault();
        replyInput.closest('.w-reply-input-wrap').querySelector('.w-reply-submit').click();
        return;
      }
    }
  });

  // ── Navigation accordion ─────────────────────────────
  document.querySelectorAll('.w-nav-group-title').forEach(function(title) {
    title.addEventListener('click', function() {
      this.closest('.w-nav-group').classList.toggle('open');
    });
  });
  document.querySelectorAll('.w-nav-subgroup-title').forEach(function(title) {
    title.addEventListener('click', function(e) {
      e.stopPropagation();
      this.closest('.w-nav-subgroup').classList.toggle('open');
    });
  });
  document.querySelectorAll('.w-nav-item.load-page').forEach(function(link) {
    link.addEventListener('click', function() {
      document.querySelectorAll('.w-nav-item').forEach(l => l.classList.remove('active'));
      this.classList.add('active');
      this.closest('.w-nav-group').classList.add('open');
    });
  });

} // end initWallApp

(function waitForJQuery() {
  if (typeof $ !== 'undefined' && typeof io !== 'undefined') {
    initWallApp();
  } else {
    setTimeout(waitForJQuery, 50);
  }
})();
</script>