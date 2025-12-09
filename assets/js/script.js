// assets/js/script.js - UI interactions + upload
document.addEventListener('DOMContentLoaded', ()=>{
  // mobile menu toggle
  const mobileBtn = document.getElementById('mobileMenuBtn');
  const nav = document.querySelector('.main-nav');
  if(mobileBtn){ mobileBtn.addEventListener('click', ()=>{ nav.classList.toggle('open'); }); }

  // search submit on enter
  const searchInput = document.getElementById('searchInput');
  if(searchInput){ searchInput.addEventListener('keydown', e=>{ if(e.key==='Enter'){ e.preventDefault(); document.getElementById('searchForm').submit(); } }); }

  // Avatar preview & upload
  const avatarInput = document.getElementById('avatarInput');
  const avatarPreview = document.getElementById('avatarPreview');
  const avatarImg = document.getElementById('avatarImg');
  const avatarName = document.getElementById('avatarName');
  const uploadAvatarBtn = document.getElementById('uploadAvatarBtn');
  const avatarMessage = document.getElementById('avatarMessage');

  if(avatarInput){
    avatarInput.addEventListener('change', ()=>{
      const f = avatarInput.files[0]; if(!f) return;
      if(f.size > 2*1024*1024){ avatarMessage.textContent='File quá lớn (max 2MB)'; return; }
      avatarImg.src = URL.createObjectURL(f);
      avatarName.textContent = f.name; avatarPreview.style.display='flex';
    });
  }
  if(uploadAvatarBtn){
    uploadAvatarBtn.addEventListener('click', ()=>{
      const f = avatarInput.files[0]; if(!f){ avatarMessage.textContent='Chưa chọn file'; return; }
      const fd = new FormData(); fd.append('avatar', f);
      fetch('/user/upload-avatar.php',{method:'POST',body:fd})
        .then(r=>r.json())
        .then(data=>{ if(data.success){ avatarMessage.textContent='Upload thành công'; if(data.url) document.querySelectorAll('.user-avatar').forEach(i=>i.src=data.url); } else avatarMessage.textContent = data.error||'Upload thất bại'; })
        .catch(()=> avatarMessage.textContent='Lỗi mạng');
    });
  }

  // Material upload (XHR để show progress)
  const materialInput = document.getElementById('materialInput');
  const uploadMaterialBtn = document.getElementById('uploadMaterialBtn');
  const materialMessage = document.getElementById('materialMessage');
  if(uploadMaterialBtn){
    uploadMaterialBtn.addEventListener('click', ()=>{
      const f = materialInput.files[0]; if(!f){ materialMessage.textContent='Chưa chọn file'; return; }
      const fd = new FormData(); fd.append('material', f);
      const xhr = new XMLHttpRequest(); xhr.open('POST', '/materials/upload.php');
      xhr.upload.onprogress = e=>{ if(e.lengthComputable){ const pct = Math.round(e.loaded/e.total*100); materialMessage.textContent = `Đã tải lên ${pct}%`; } }
      xhr.onload = ()=>{ try{ const data = JSON.parse(xhr.responseText); if(data.success) materialMessage.textContent='Upload thành công'; else materialMessage.textContent = data.error||'Upload thất bại'; }catch(e){ materialMessage.textContent='Lỗi phản hồi server'; } }
      xhr.onerror = ()=> materialMessage.textContent='Lỗi mạng'; xhr.send(fd);
    });
  }

});