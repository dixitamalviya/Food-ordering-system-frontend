// Show quantity buttons on "Order Now" click
document.querySelectorAll('.order-now').forEach(button => {
    button.addEventListener('click', () => {
      const quantityButtons = button.parentElement.nextElementSibling;
      quantityButtons.style.display = 'flex';
      button.style.display = 'none';
    });
  });
  
  // Increase quantity
  document.querySelectorAll('.increase').forEach(button => {
    button.addEventListener('click', () => {
      const quantity = button.previousElementSibling;
      quantity.textContent = parseInt(quantity.textContent) + 1;
    });
  });
  
  // Decrease quantity
  document.querySelectorAll('.decrease').forEach(button => {
    button.addEventListener('click', () => {
      const quantity = button.nextElementSibling;
      if (parseInt(quantity.textContent) > 0) {
        quantity.textContent = parseInt(quantity.textContent) - 1;
      }
    });
  });
  
  // Show pop-up on "Order" button click
  document.querySelectorAll('.final-order').forEach(button => {
    button.addEventListener('click', () => {
      document.querySelector('.overlay').style.display = 'block';
      document.querySelector('.popup').style.display = 'block';
    });
  });
  
  // Close pop-up
  document.querySelector('.close-popup').addEventListener('click', () => {
    document.querySelector('.overlay').style.display = 'none';
    document.querySelector('.popup').style.display = 'none';
  });
  