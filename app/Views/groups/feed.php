<?php /* app/Views/groups/feed.php */ ?>

<style>
.gf-page {
  display: grid;
  grid-template-columns: 240px 1fr 220px;
  gap: 20px; padding: 20px; align-items: start;
}
/* Reuse wall styles — same wcard, wbtn etc */
.gf-back {
  display: inline-flex; align-items: center; gap: 6px;
  font-size: 0.82rem; color: #6b7280; cursor: pointer;
  margin-bottom: 14px; background: none; border: none;
  transition: color 0.15s;
}
.gf-back:hover { color: #c8522a; }
.gf-group-cover {
  height: 70px;
  background: linear-gradient(135deg, #0f1117 0%, #c8522a 100%);
  border-radius: 8px 8px 0 0;
}
.gf-group-name {
  font-size: 1rem; font-weight: 700;
  text-align: center; color: #0f1117; margin-bottom: 2px;
}
.gf-group-desc {
  font-size: 0.78rem; color: #6b7280;
  text-align: center; margin-bottom: 8px;
  padding: 0 12px;
}
.gf-member-item {
  display: flex; align-items: center; gap: 8px;
  padding: 8px 0; border-bottom: 1px solid #e5e1db;
  font-size: 0.82rem; color: #2b2f3a;
}
.gf-member-item:last-child { border-bottom: none; }
.gf-member-avatar {
  width: 28px; height: 28px; border-radius: 50%;
  background: #e5e1db; display: flex; align-items: center;
  justify-content: center; font-size: 0.75rem; color: #6b7280;
  flex-shrink: 0;
}
.gf-pending-item {
  display: flex; align-items: center; gap: 8px;
  padding: 8px 0; border-bottom: 1px solid #e5e1db;
  font-size: 0.82rem;
}
.gf-pending-item:last-child { border-bottom: none; }
.gf-approve-btn {
  background: #e8f5e9; color: #2e7d32;
  border: 1px solid #c8e6c9; border-radius: 5px;
  padding: 3px 8px; font-size: 0.75rem;
  cursor: pointer; transition: all 0.15s;
}
.gf-approve-btn:hover { background: #c8e6c9; }
.gf-reject-btn {
  background: #fef2ef; color: #c8522a;
  border: 1px solid #f5c6b3; border-radius: 5px;
  padding: 3px 8px; font-size: 0.75rem;
  cursor: pointer; transition: all 0.15s; margin-left: 4px;
}
.gf-reject-btn:hover { background: #f5c6b3; }
.gf-locked {
  text-align: center; padding: 40px 20px;
  color: #6b7280;
}
.gf-locked i { font-size: 2.5rem; color: #e5e1db; margin-bottom: 12px; display: block; }
.gf-locked h3 { font-size: 1rem; font-weight: 700; margin-bottom: 8px; color: #2b2f3a; }
.gf-locked p { font-size: 0.85rem; line-height: 1.6; }

.gf-page {
  display: grid;
  grid-template-columns: 240px 1fr 220px;
  gap: 70px;
  padding: 20px;
  align-items: start;
}
</style>

<div class="gf-page">

  <!-- LEFT -->
  <div>
    <div class="wcard">
      <div class="gf-group-cover"></div>
      <div class="wcard-body" style="padding-top:12px;">
        <button class="gf-back load-page" data-url="<?= base_url('groups') ?>">
          <i class="fa fa-arrow-left"></i> All Groups
        </button>
        <div class="gf-group-name"><?= esc($group['name']) ?></div>
        <div class="gf-group-desc"><?= esc($group['description'] ?: '') ?></div>
      </div>
      <div class="w-profile-stats">
        <div class="w-stat-block">
          <span class="w-stat-num"><?= count($members) ?></span>
          <span class="w-stat-label">Members</span>
        </div>
        <div class="w-stat-block">
          <span class="w-stat-num" id="gf-post-count">—</span>
          <span class="w-stat-label">Posts</span>
        </div>
        <div class="w-stat-block">
          <span class="w-stat-num"><?= count($pending) ?></span>
          <span class="w-stat-label">Pending</span>
        </div>
      </div>
    </div>

    <!-- Members -->
<div class="wcard">
  <div class="wcard-header">Members</div>
  <div class="wcard-body" id="gf-members-list" style="padding-top:8px;padding-bottom:8px;">
    <?php foreach($members as $m): ?>
    <div class="gf-member-item">
      <div class="gf-member-avatar"><i class="fa fa-user"></i></div>
      <?= esc($m['full_name']) ?>
    </div>
    <?php endforeach; ?>
    <?php if(empty($members)): ?>
      <div id="gf-no-members" style="font-size:0.82rem;color:#6b7280;padding:8px 0;">No members yet.</div>
    <?php endif; ?>
  </div>
</div>
    <!-- Pending requests (admin only) -->
    <?php if(session()->get('role') === 'admin' && !empty($pending)): ?>
    <div class="wcard">
      <div class="wcard-header">Pending Requests</div>
      <div class="wcard-body" style="padding-top:8px;padding-bottom:8px;" id="gf-pending-list">
        <?php foreach($pending as $p): ?>
        <div class="gf-pending-item" id="pending-<?= $p['user_id'] ?>">
          <div class="gf-member-avatar"><i class="fa fa-user"></i></div>
          <span style="flex:1;"><?= esc($p['full_name']) ?></span>
          <button class="gf-approve-btn" onclick="approveMember(<?= $group['id'] ?>, <?= $p['user_id'] ?>)">
            <i class="fa fa-check"></i> Approve
          </button>
          <button class="gf-reject-btn" onclick="rejectMember(<?= $group['id'] ?>, <?= $p['user_id'] ?>)">
            <i class="fa fa-times"></i> Reject
          </button>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <!-- CENTER -->
  <div>
    <?php if($isMember): ?>
    <!-- Create post -->
    <div class="wcard" style="margin-bottom:18px;">
      <div class="wcard-body">
        <div class="w-post-input-wrap">
          <img class="w-post-input-avatar" src="https://randomuser.me/api/portraits/men/44.jpg" alt="">
          <textarea id="gf-content" class="w-post-textarea" rows="3"
            placeholder="Share something with <?= esc($group['name']) ?>..."></textarea>
        </div>
        <div id="gf-file-previews" class="w-file-preview-wrap"></div>
        <input type="file" id="gf-attachment-input" accept="image/*,.pdf" multiple style="display:none;">
        <div class="w-post-actions">
          <button class="wbtn wbtn-ghost" id="gf-attach-btn">
            <i class="fa fa-paperclip"></i> Attach
          </button>
          <button id="gf-post-btn" class="wbtn wbtn-primary">
            <i class="fa fa-paper-plane"></i> Publish
          </button>
        </div>
      </div>
    </div>
    <div id="gf-posts"></div>

    <?php else: ?>
<!-- Not a member -->
<div class="wcard">
  <div class="wcard-body">
    <div class="gf-locked">
      <i class="fa fa-lock"></i>
      <h3>You're not a member</h3>
      <p>Join this group to see and post content.</p>
      <button class="wbtn wbtn-primary" style="margin-top:14px;"
              onclick="requestJoinFeed(<?= $group['id'] ?>, this)">
        <i class="fa fa-plus"></i> Join Group
      </button>
    </div>
  </div>
</div>
<?php endif; ?>
  </div>

  <!-- RIGHT -->
  <div>
    <div class="wcard">
      <div class="wcard-header">About this Group</div>
      <div class="wcard-body">
        <div style="font-size:0.85rem;color:#2b2f3a;line-height:1.6;">
          <?= esc($group['description'] ?: 'No description provided.') ?>
        </div>
        <div style="margin-top:12px;font-size:0.78rem;color:#6b7280;">
          <i class="fa fa-calendar"></i>
          Created <?= date('M d, Y', strtotime($group['created_at'])) ?>
        </div>
      </div>
    </div>
  </div>

</div>

<?php if($isMember): ?>
<script>
(function() {
  const BASE  = typeof BASE_URL !== 'undefined' ? BASE_URL : '/';
  const GROUP = <?= $group['id'] ?>;
  let gfFiles = [];

  const avatarIds = [10,12,18,22,28,32,36,39,41,43,46,52];
  function rand(arr) { return arr[Math.floor(Math.random() * arr.length)]; }
  function randAvatar() { return `https://randomuser.me/api/portraits/men/${rand(avatarIds)}.jpg`; }

  // ── Pagination state ─────────────────────────────────
  let gOffset  = 0;
  const GLIMIT = 15;
  let gLoading = false;
  let gHasMore = true;
  let gTotal   = 0;

  // ── Feed footer ──────────────────────────────────────
  function renderFeedFooter() {
    const existing = document.getElementById('gf-feed-footer');
    if (existing) existing.remove();

    if (!gHasMore) {
      const footer = document.createElement('div');
      footer.id = 'gf-feed-footer';
      footer.style.cssText = 'text-align:center; padding:24px 0 40px;';
      footer.innerHTML = `
        <div style="display:inline-flex;flex-direction:column;align-items:center;gap:8px;color:#6b7280;">
          <div style="width:48px;height:2px;background:linear-gradient(90deg,transparent,#e5e1db,transparent);margin-bottom:4px;"></div>
          <i class="fa fa-check-circle" style="font-size:1.5rem;color:#c8e6c9;"></i>
          <span style="font-size:0.88rem;font-weight:600;color:#2b2f3a;">You're all caught up!</span>
          <span style="font-size:0.78rem;">No more posts to show</span>
        </div>`;
      document.getElementById('gf-posts').appendChild(footer);
    }
  }

  // ── Loading spinner ──────────────────────────────────
  function renderLoadingSpinner(show) {
    const existing = document.getElementById('gf-loading-spinner');
    if (show) {
      if (existing) return;
      const spinner = document.createElement('div');
      spinner.id = 'gf-loading-spinner';
      spinner.style.cssText = 'text-align:center;padding:20px 0;';
      spinner.innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:1.5rem;color:#c8522a;"></i>';
      document.getElementById('gf-posts').appendChild(spinner);
    } else {
      if (existing) existing.remove();
    }
  }

  // ── Fetch posts ──────────────────────────────────────
  function fetchGroupPosts(append = false) {
    if (gLoading) return;
    gLoading = true;

    renderLoadingSpinner(true);

    $.get(BASE + 'groups/' + GROUP + '/posts', { offset: gOffset }, function(res) {
      renderLoadingSpinner(false);

      const feed   = document.getElementById('gf-posts');
      const footer = document.getElementById('gf-feed-footer');
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
        gLoading = false;
        gHasMore = false;
        renderFeedFooter();
        return;
      }

      res.posts.forEach(p => {
        if (!document.querySelector(`[data-post-id="${p.id}"]`)) {
          feed.appendChild(buildCard(p));
        }
      });

      gOffset  = res.offset + res.posts.length;
      gHasMore = res.hasMore;
      gTotal   = res.total;
      gLoading = false;

      const countEl = document.getElementById('gf-post-count');
      if (countEl) countEl.textContent = gTotal;

      renderFeedFooter();
    });
  }

  // ── Infinite scroll ──────────────────────────────────
  function setupInfiniteScroll() {
    const scrollEl = document.getElementById('content-area')
                  || document.getElementById('main-content')
                  || window;

    function onScroll() {
      if (!gHasMore || gLoading) return;

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
        fetchGroupPosts(true);
      }
    }

    scrollEl.addEventListener('scroll', onScroll);
    if (scrollEl !== window) window.addEventListener('scroll', onScroll);
  }

  // Initial load
  fetchGroupPosts(false);
  setupInfiniteScroll();

  // ── Attachments html ─────────────────────────────────
  function buildAttachmentsHtml(attachments) {
    if (!attachments || !attachments.length) return '';
    return attachments.map(a => {
      if (a.mime_type.startsWith('image')) return `<img class="w-post-image" src="/${a.file_path}" alt="attachment">`;
      if (a.mime_type === 'application/pdf') return `<iframe src="/${a.file_path}" style="width:100%;height:300px;"></iframe>`;
      return `<a href="/${a.file_path}" target="_blank">Download file</a>`;
    }).join('');
  }

  // ── Build card ───────────────────────────────────────
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
            <div class="w-post-time">${p.created_at || 'Just now'}</div>
          </div>
          ${p.id ? `<button class="w-del-btn" data-post-id="${p.id}" title="Delete"><i class="fa fa-trash"></i></button>` : ''}
        </div>
        <div class="w-post-content">${p.content || ''}</div>
        ${buildAttachmentsHtml(p.attachments || [])}
        <div class="w-post-footer">
          <button class="w-post-action-btn w-like-btn" data-post-id="${p.id || ''}">
            <i class="fa fa-heart-o"></i>
            <span class="w-like-count">${p.likes || 0}</span>
          </button>
          <button class="w-post-action-btn w-comment-toggle-btn" data-post-id="${p.id || ''}">
            <i class="fa fa-comment-o"></i> Comment
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
    if (p.comments && p.comments.length) {
      const list = div.querySelector('.w-comments-list');
      p.comments.forEach(c => list.appendChild(buildComment(c, 0)));
    }
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

  // ── Post + comment actions ────────────────────────────
  document.getElementById('gf-posts').addEventListener('click', function(e) {

    // ── Delete post ──────────────────────────────────
    const delBtn = e.target.closest('.w-del-btn');
    if (delBtn) {
      if (!confirm('Delete this post?')) return;
      const postCard = delBtn.closest('.w-post-card');
      postCard.style.opacity = '0'; postCard.style.transition = 'opacity 0.25s';
      setTimeout(() => postCard.remove(), 260);
      $.post(BASE + 'groups/posts/delete/' + delBtn.dataset.postId);
      gOffset = Math.max(0, gOffset - 1);
      gTotal  = Math.max(0, gTotal - 1);
      const countEl = document.getElementById('gf-post-count');
      if (countEl) countEl.textContent = gTotal;
      return;
    }

    // ── Like ─────────────────────────────────────────
    const likeBtn = e.target.closest('.w-like-btn');
    if (likeBtn) {
      const postId  = likeBtn.dataset.postId;
      const countEl = likeBtn.querySelector('.w-like-count');
      const icon    = likeBtn.querySelector('i');
      const isLiked = likeBtn.classList.contains('liked');
      if (isLiked) {
        likeBtn.classList.remove('liked'); icon.className = 'fa fa-heart-o';
        countEl.textContent = Math.max(0, parseInt(countEl.textContent) - 1);
      } else {
        likeBtn.classList.add('liked'); icon.className = 'fa fa-heart';
        countEl.textContent = parseInt(countEl.textContent) + 1;
        if (postId) $.post(BASE + 'groups/posts/like/' + postId, function(res) {
          if (res.likes !== undefined) countEl.textContent = res.likes;
        });
      }
      return;
    }

    // ── Toggle comments ───────────────────────────────
    const commentBtn = e.target.closest('.w-comment-toggle-btn');
    if (commentBtn) {
      const postCard = commentBtn.closest('.w-post-card');
      const list     = postCard.querySelector('.w-comments-list');
      list.style.display = (list.style.display === 'none' || !list.style.display) ? 'block' : 'none';
      return;
    }

    // ── Submit comment ────────────────────────────────
    const submitBtn = e.target.closest('.w-comment-submit');
    if (submitBtn) {
      const postCard = submitBtn.closest('.w-post-card');
      const postId   = postCard.dataset.postId;
      const input    = postCard.querySelector('.w-comment-input');
      const content  = input.value.trim();
      if (!content) { input.focus(); return; }
      $.post(BASE + 'groups/posts/comments/add/' + postId, { content }, function(res) {
        const list = postCard.querySelector('.w-comments-list');
        list.style.display = 'block';
        list.appendChild(buildComment(res, 0));
        input.value = '';
      });
      return;
    }

    // ── Delete comment ────────────────────────────────
    const delComment = e.target.closest('.w-comment-del');
    if (delComment) {
      if (!confirm('Delete comment?')) return;
      const item = delComment.closest('.w-comment-item');
      item.style.opacity = '0'; item.style.transition = 'opacity 0.2s';
      setTimeout(() => item.remove(), 220);
      $.post(BASE + 'groups/posts/comments/delete/' + delComment.dataset.commentId);
      return;
    }

    // ── View replies ──────────────────────────────────
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

      $.get(BASE + 'groups/comments/' + commentId + '/replies', function(replies) {
        repliesWrap.innerHTML = '';
        replies.forEach(r => repliesWrap.appendChild(buildComment(r, 1)));
        repliesWrap.style.display = 'block';
        viewRepliesBtn.dataset.loaded = '1';
        viewRepliesBtn.innerHTML = `<i class="fa fa-chevron-up"></i> Hide replies`;
      });
      return;
    }

    // ── Reply button ──────────────────────────────────
    const replyBtn = e.target.closest('.w-reply-btn');
    if (replyBtn) {
      const commentId = replyBtn.dataset.commentId;
      const inputWrap = document.getElementById('reply-input-' + commentId);
      const isVisible = inputWrap.style.display !== 'none';
      inputWrap.style.display = isVisible ? 'none' : 'flex';
      if (!isVisible) inputWrap.querySelector('.w-reply-input').focus();
      return;
    }

    // ── Submit reply ──────────────────────────────────
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

      $.post(BASE + 'groups/posts/comments/add/' + postId, { content, parentId }, function(res) {
        const repliesWrap = document.getElementById('replies-' + parentId);
        repliesWrap.appendChild(buildComment(res, depth + 1));
        repliesWrap.style.display = 'block';
        input.value = '';
        inputWrap.style.display = 'none';

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
  });

  // ── Comment / Reply enter key ─────────────────────────
  document.getElementById('gf-posts').addEventListener('keydown', function(e) {
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

  // ── Attach files ─────────────────────────────────────
  const attachInput = document.getElementById('gf-attachment-input');
  const previewWrap = document.getElementById('gf-file-previews');

  document.getElementById('gf-attach-btn').addEventListener('click', function() { attachInput.click(); });

  attachInput.addEventListener('change', function() {
    Array.from(this.files).forEach(file => {
      gfFiles.push(file);
      const thumb = document.createElement('div');
      thumb.className = 'w-file-thumb';
      const idx = gfFiles.length - 1;
      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
          thumb.innerHTML = `<img src="${e.target.result}" alt=""><button class="w-file-thumb-remove" data-idx="${idx}">✕</button>`;
        };
        reader.readAsDataURL(file);
      } else {
        thumb.innerHTML = `<div class="w-pdf-thumb"><i class="fa fa-file-pdf-o"></i><span>${file.name}</span></div><button class="w-file-thumb-remove" data-idx="${idx}">✕</button>`;
      }
      previewWrap.appendChild(thumb);
    });
    this.value = '';
  });

  previewWrap.addEventListener('click', function(e) {
    const btn = e.target.closest('.w-file-thumb-remove');
    if (!btn) return;
    gfFiles[parseInt(btn.dataset.idx)] = null;
    btn.closest('.w-file-thumb').remove();
  });

  // ── Publish ──────────────────────────────────────────
  document.getElementById('gf-post-btn').addEventListener('click', function() {
    const ta      = document.getElementById('gf-content');
    const content = ta.value.trim();
    const files   = gfFiles.filter(f => f !== null);
    if (!content && !files.length) { ta.focus(); return; }

    const formData = new FormData();
    formData.append('content', content);
    files.forEach(f => formData.append('attachments', f));

    $.ajax({
      url: BASE + 'groups/' + GROUP + '/posts',
      type: 'POST', data: formData,
      processData: false, contentType: false,
      success: function(res) {
        const feed = document.getElementById('gf-posts');
        const card = buildCard(res);
        if (feed.firstChild) {
          feed.insertBefore(card, feed.firstChild);
        } else {
          feed.appendChild(card);
        }
        ta.value = ''; gfFiles = []; previewWrap.innerHTML = '';
        gOffset++; gTotal++;
        const countEl = document.getElementById('gf-post-count');
        if (countEl) countEl.textContent = gTotal;
      },
      error: function() { alert('Failed to post'); }
    });
  });

})();

// ── Admin actions ─────────────────────────────────────
function approveMember(groupId, userId) {
  $.post(BASE_URL + 'groups/approve/' + groupId + '/' + userId, function() {
    const pendingItem = document.getElementById('pending-' + userId);
    const name = pendingItem.querySelector('span').textContent.trim();
    pendingItem.remove();
    const allStats = document.querySelectorAll('.w-stat-num');
    allStats.forEach(el => {
      if (el.nextElementSibling && el.nextElementSibling.textContent.trim() === 'Pending')
        el.textContent = Math.max(0, parseInt(el.textContent) - 1);
      if (el.nextElementSibling && el.nextElementSibling.textContent.trim() === 'Members')
        el.textContent = parseInt(el.textContent) + 1;
    });
    const membersList = document.getElementById('gf-members-list');
    if (membersList) {
      const empty = document.getElementById('gf-no-members');
      if (empty) empty.remove();
      const memberItem = document.createElement('div');
      memberItem.className = 'gf-member-item';
      memberItem.innerHTML = `<div class="gf-member-avatar"><i class="fa fa-user"></i></div>${name}`;
      membersList.appendChild(memberItem);
    }
    const pendingList = document.getElementById('gf-pending-list');
    if (pendingList && pendingList.children.length === 0)
      pendingList.closest('.wcard').style.display = 'none';
  });
}

function rejectMember(groupId, userId) {
  $.post(BASE_URL + 'groups/reject/' + groupId + '/' + userId, function() {
    document.getElementById('pending-' + userId).remove();
    const allStats = document.querySelectorAll('.w-stat-num');
    allStats.forEach(el => {
      if (el.nextElementSibling && el.nextElementSibling.textContent.trim() === 'Pending')
        el.textContent = Math.max(0, parseInt(el.textContent) - 1);
    });
    const pendingList = document.getElementById('gf-pending-list');
    if (pendingList && pendingList.children.length === 0)
      pendingList.closest('.wcard').style.display = 'none';
  });
}

function requestJoinFeed(groupId, btn) {
  const BASE = typeof BASE_URL !== 'undefined' ? BASE_URL : '/';
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Joining...';

  $.post(BASE + 'groups/join/' + groupId, function(res) {
    if (res.success) {
      loadPage(BASE + 'groups/feed/' + groupId);
    }
  });
}
</script>
<?php endif; ?>