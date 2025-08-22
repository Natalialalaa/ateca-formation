document.addEventListener('DOMContentLoaded', function () {
  const btn   = document.querySelector('.js-menu-toggle');
  const list  = document.querySelector('.header__nav--mobile .nav__list');
  if (!btn || !list) return;

  const openI  = btn.querySelector('.open-icon');
  const closeI = btn.querySelector('.close-icon');

  function openMenu() {
    list.classList.add('active');   // your CSS shows the panel
    if (openI)  openI.style.display  = 'none';
    if (closeI) closeI.style.display = 'inline';
  }
  function closeMenu() {
    list.classList.remove('active');
    if (closeI) closeI.style.display = 'none';
    if (openI)  openI.style.display  = 'inline';
  }

  let isOpen = false;
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    isOpen ? closeMenu() : openMenu();
    isOpen = !isOpen;
  });

  document.querySelectorAll('.header__nav--mobile .nav__link')
    .forEach(a => a.addEventListener('click', () => { if (isOpen) { closeMenu(); isOpen = false; } }));

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && isOpen) { closeMenu(); isOpen = false; }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".progress-circle").forEach(circle => {
    const percent = parseInt(circle.dataset.percent, 10);
    const totalLength = 126; // half arc
    const offset = totalLength * (1 - percent / 100);
    circle.style.strokeDashoffset = offset;

    // Update percentage text (optional)
    const text = circle.parentElement.querySelector('.percentage');
    if (text) text.textContent = `${percent}%`;
  });

  
});

document.addEventListener("DOMContentLoaded", () => {
  // Hide all lists initially and set "+" symbol
  document.querySelectorAll('.formation-details__text').forEach(text => {
    const ul = text.querySelector('.formation-details__list');
    if (ul) {
      ul.style.maxHeight = '0';
      ul.style.overflow = 'hidden';
      ul.style.transition = 'max-height 0.4s cubic-bezier(0.4,0,0.2,1)';
    }
    const toggle = text.querySelector('.formation-details__toggle');
    if (toggle) toggle.textContent = '+';
  });

  // Toggle on h3 click
  document.querySelectorAll('.formation-details__subtitle').forEach(h3 => {
    h3.addEventListener('click', () => {
      const textDiv = h3.parentElement;
      const ul = textDiv.querySelector('.formation-details__list');
      const toggle = h3.querySelector('.formation-details__toggle');
      if (!ul || !toggle) return;

      const isOpen = ul.style.maxHeight && ul.style.maxHeight !== '0px';
      if (isOpen) {
        ul.style.maxHeight = '0';
        toggle.textContent = '+';
      } else {
        ul.style.maxHeight = ul.scrollHeight + 'px';
        toggle.textContent = '-';
      }
    });
  });
});