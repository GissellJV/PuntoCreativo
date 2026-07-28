
document.addEventListener('DOMContentLoaded',()=>{
  PCStore.bindSearch();PCStore.initCookieBanner();PCStore.updateCartBadges();
  document.querySelectorAll('[data-add-featured]').forEach(btn=>btn.addEventListener('click',()=>PCStore.addToCart(btn.dataset.addFeatured,1,'Estándar')));
});
