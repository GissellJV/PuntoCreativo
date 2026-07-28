
document.addEventListener('DOMContentLoaded',()=>{
 const grid=document.getElementById('productGrid'), count=document.getElementById('resultCount'), pag=document.getElementById('pagination');
 const cats=[...new Set(PC_PRODUCTS.map(p=>p.category))];let page=1;const pageSize=4;
 const params=new URLSearchParams(location.search);const query=(params.get('q')||'').toLowerCase();
 document.getElementById('categoryFilters').innerHTML='<strong>Categorías</strong>'+cats.map(c=>`<label><input type="checkbox" value="${c}"> ${c}</label>`).join('');
 function selected(){return [...document.querySelectorAll('#categoryFilters input:checked')].map(i=>i.value)}
 function render(){let list=[...PC_PRODUCTS];const sel=selected(),max=+document.getElementById('priceRange').value,sort=document.getElementById('sortSelect').value;
  list=list.filter(p=>(!sel.length||sel.includes(p.category))&&p.price<=max&&(!query||(p.name+' '+p.short+' '+p.category).toLowerCase().includes(query)));
  if(sort==='price-asc')list.sort((a,b)=>a.price-b.price);if(sort==='price-desc')list.sort((a,b)=>b.price-a.price);if(sort==='name')list.sort((a,b)=>a.name.localeCompare(b.name));
  const pages=Math.max(1,Math.ceil(list.length/pageSize));if(page>pages)page=pages;const shown=list.slice((page-1)*pageSize,page*pageSize);
  count.textContent=`${list.length} servicio${list.length===1?'':'s'} encontrado${list.length===1?'':'s'}${query?' para “'+query+'”':''}`;
  grid.innerHTML=shown.length?shown.map(card).join(''):'<div class="empty-state"><h3>No encontramos servicios con esos filtros.</h3><p>Prueba otra categoría o aumenta el precio máximo.</p></div>';
  pag.innerHTML=Array.from({length:pages},(_,i)=>`<button class="page-btn ${i+1===page?'active':''}" data-page="${i+1}">${i+1}</button>`).join('');
  grid.querySelectorAll('[data-add]').forEach(b=>b.onclick=()=>PCStore.addToCart(b.dataset.add,1,'Estándar'));pag.querySelectorAll('[data-page]').forEach(b=>b.onclick=()=>{page=+b.dataset.page;render();if(!navigator.userAgent.includes('jsdom')){window.scrollTo({top:document.querySelector('.catalog-toolbar').offsetTop-100,behavior:'smooth'})}});
 }
 function card(p){return `<article class="product-card"><a class="product-media" href="producto.html?id=${p.id}"><img src="assets/img/${p.id}-main.svg" width="1000" height="750" loading="lazy" alt="Muestra de ${p.name}"><span class="product-badge">${p.badge}</span></a><div class="product-body"><span class="product-category">${p.category}</span><h3><a href="producto.html?id=${p.id}">${p.name}</a></h3><p>${p.short}</p><div class="product-price">${PCStore.formatMoney(p.price)}</div><div class="card-actions"><a class="btn btn-secondary" href="producto.html?id=${p.id}">Ver detalle</a><button class="icon-btn" data-add="${p.id}" aria-label="Agregar ${p.name} al carrito">＋</button></div></div></article>`}
 document.querySelectorAll('#categoryFilters input').forEach(i=>i.onchange=()=>{page=1;render()});document.getElementById('priceRange').oninput=e=>{document.getElementById('priceOutput').textContent=PCStore.formatMoney(e.target.value).replace('.00','');page=1;render()};document.getElementById('sortSelect').onchange=()=>render();document.getElementById('clearFilters').onclick=()=>{document.querySelectorAll('#categoryFilters input').forEach(i=>i.checked=false);document.getElementById('priceRange').value=1500;document.getElementById('priceOutput').textContent='L 1,500';page=1;render()};render();
});
