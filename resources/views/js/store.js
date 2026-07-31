
(function(){
  const CART_KEY='pcCart';
  const ORDERS_KEY='pcOrders';
  const LAST_ORDER_KEY='pcLastOrder';
  const COUPON_KEY='pcCoupon';
  const formatMoney = value => new Intl.NumberFormat('es-HN',{style:'currency',currency:'HNL',minimumFractionDigits:2}).format(Number(value)||0);
  const products = () => window.PC_PRODUCTS || [];
  const findProduct = id => products().find(p=>p.id===id);
  const getCart = () => { try{return JSON.parse(localStorage.getItem(CART_KEY))||[]}catch(e){return[]} };
  const setCart = cart => { localStorage.setItem(CART_KEY,JSON.stringify(cart)); updateCartBadges(); window.dispatchEvent(new CustomEvent('pc:cart')); };
    const addToCart = (product, qty = 1, variant = 'Estándar') => {
        qty = Math.max(1, parseInt(qty) || 1);

        const cart = getCart();

        const id = String(product.id);

        const existing = cart.find(item =>
            String(item.id) === id &&
            item.variant === variant
        );

        if (existing) {
            existing.qty += qty;
        } else {
            cart.push({
                id: id,
                name: product.name,
                price: Number(product.price),
                image: product.image,
                qty: qty,
                variant: variant
            });
        }

        setCart(cart);
        showToast('Servicio agregado al carrito');
    };
  const updateItem=(id,variant,qty)=>{const cart=getCart();const item=cart.find(i=>i.id===id&&i.variant===variant);if(item){item.qty=Math.max(1,parseInt(qty)||1);setCart(cart)}};
  const removeItem=(id,variant)=>setCart(getCart().filter(i=>!(i.id===id&&i.variant===variant)));
  const clearCart=()=>{localStorage.removeItem(CART_KEY);localStorage.removeItem(COUPON_KEY);updateCartBadges();window.dispatchEvent(new CustomEvent('pc:cart'))};
  const cartCount=()=>getCart().reduce((s,i)=>s+i.qty,0);
  const cartDetails = () => getCart();  const subtotal=()=>cartDetails().reduce((s,i)=>s+i.product.price*i.qty,0);
  const coupon=()=>localStorage.getItem(COUPON_KEY)||'';
  const setCoupon=code=>localStorage.setItem(COUPON_KEY,code);
    const totals = () => {
        const sub = subtotal();

        const code = coupon().trim().toUpperCase();

        const discount = code === 'CREATIVO10'
            ? sub * 0.10
            : 0;

        const taxable = sub - discount;
        const tax = taxable * 0.15;

        return {
            sub,
            discount,
            tax,
            total: taxable + tax
        };
    };
  const saveOrder=order=>{const orders=JSON.parse(localStorage.getItem(ORDERS_KEY)||'[]');orders.unshift(order);localStorage.setItem(ORDERS_KEY,JSON.stringify(orders));localStorage.setItem(LAST_ORDER_KEY,JSON.stringify(order));};
  const orders=()=>{try{return JSON.parse(localStorage.getItem(ORDERS_KEY))||[]}catch(e){return[]}};
  const lastOrder=()=>{try{return JSON.parse(localStorage.getItem(LAST_ORDER_KEY))}catch(e){return null}};
  function updateCartBadges(){document.querySelectorAll('[data-cart-count]').forEach(el=>el.textContent=cartCount())}
  function showToast(message){let t=document.querySelector('.toast');if(!t){t=document.createElement('div');t.className='toast';document.body.appendChild(t)}t.textContent=message;t.classList.add('show');clearTimeout(window.__pcToast);window.__pcToast=setTimeout(()=>t.classList.remove('show'),2200)}
  function bindSearch(){document.querySelectorAll('[data-search-form]').forEach(form=>form.addEventListener('submit',e=>{e.preventDefault();const q=form.querySelector('input').value.trim();location.href='catalogo.html'+(q?'?q='+encodeURIComponent(q):'')}))}
  function initCookieBanner(){if(localStorage.getItem('pcCookies'))return;const banner=document.createElement('div');banner.className='cookie-banner';banner.innerHTML='<p><strong>Preferencias de cookies.</strong> Este prototipo usa almacenamiento local para conservar el carrito y los pedidos de demostración. <a href="cookies.html" style="color:var(--cyan)">Más información</a>.</p><div class="cookie-actions"><button class="btn btn-secondary" data-cookie="necessary">Solo necesarias</button><button class="btn btn-primary" data-cookie="all">Aceptar</button></div>';document.body.appendChild(banner);banner.querySelectorAll('[data-cookie]').forEach(b=>b.onclick=()=>{localStorage.setItem('pcCookies',b.dataset.cookie);banner.remove()})}
  window.PCStore={formatMoney,products,findProduct,getCart,setCart,addToCart,updateItem,removeItem,clearCart,cartCount,cartDetails,subtotal,coupon,setCoupon,totals,saveOrder,orders,lastOrder,updateCartBadges,showToast,bindSearch,initCookieBanner};
  document.addEventListener('DOMContentLoaded',()=>{updateCartBadges();});
})();
