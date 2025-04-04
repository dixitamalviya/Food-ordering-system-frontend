// Get the current date
let currentDate = new Date().toLocaleDateString();

// Update the date row in the HTML
document.getElementById('invoiceDate').innerText = currentDate;
window.onload = function() {
    displayBill();
    const params = new URLSearchParams(window.location.search);
    const item = params.get('item');
    const quantity = parseInt(params.get('quantity'));
    const rate = parseFloat(params.get('rate'));

    if (item && quantity && rate) {
        let bill = JSON.parse(sessionStorage.getItem('bill')) || [];
        let existingItem = bill.find(billItem => billItem.name === item);

        if (!existingItem) {
            addItemToBill({ name: item, quantity: quantity, rate: rate });
            sessionStorage.setItem('item', item);
            sessionStorage.setItem('quantity', quantity);
            sessionStorage.setItem('rate', rate);
        }
    }

    document.getElementById('addItemForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const itemName = sanitizeInput(document.getElementById('itemName').value);
        const itemQuantity = parseInt(sanitizeInput(document.getElementById('itemQuantity').value));
        const itemRate = parseFloat(sanitizeInput(document.getElementById('itemRate').value));
    
        if (itemName && !isNaN(itemQuantity) && !isNaN(itemRate)) {
            addItemToBill({ name: itemName, quantity: itemQuantity, rate: itemRate });
            sessionStorage.setItem('item', itemName);
            sessionStorage.setItem('quantity', itemQuantity);
            sessionStorage.setItem('rate', itemRate);
            document.getElementById('addItemForm').reset();
        } else {
            alert('Please enter valid item details.');
        }
    });

    // Session timeout logic
    setTimeout(() => {
        alert("Session expired. Please log in again.");
        // Code to log out user or redirect to login page
    }, 30 * 60 * 1000); // 30 minutes
};

function sanitizeInput(input) {
    const element = document.createElement('div');
    element.innerText = input;
    return element.textContent || element.innerText;
}
window.onload = function() {
    displayBill();
    const params = new URLSearchParams(window.location.search);
    const item = sanitizeInput(params.get('item'));
    const quantity = parseInt(sanitizeInput(params.get('quantity')));
    const rate = parseFloat(sanitizeInput(params.get('rate')));

    // Predefined list of allowed items
    const allowedItems = ['item1', 'item2', 'item3']; // Replace with actual item names

    if (item && !isNaN(quantity) && !isNaN(rate) && allowedItems.includes(item)) {
        let bill = JSON.parse(sessionStorage.getItem('bill')) || [];
        let existingItem = bill.find(billItem => billItem.name === item);

        if (!existingItem) {
            addItemToBill({ name: item, quantity: quantity, rate: rate });
            sessionStorage.setItem('item', item);
            sessionStorage.setItem('quantity', quantity);
            sessionStorage.setItem('rate', rate);
        }
    }
};

function displayBill() {
    let bill = JSON.parse(sessionStorage.getItem('bill')) || [];
    let itemsContainer = document.getElementById('items');
    let totalContainer = document.getElementById('totalPrice');
    let total = 0;

    // Clear the previous items
    itemsContainer.innerHTML = '';

    bill.forEach(item => {
        let row = document.createElement('tr');
        row.innerHTML = `
            <td><a class="cut" onclick="removeRow(this)">-</a><span>${item.name}</span></td>
            <td><span data-prefix="₹"></span><span>${item.rate.toFixed(2)}</span></td>
            <td><span>${item.quantity}</span></td>
            <td><span data-prefix="₹"></span><span>${(item.rate * item.quantity).toFixed(2)}</span></td>
        `;
        itemsContainer.appendChild(row);
        total += item.rate * item.quantity;
    });

    totalContainer.innerText = total.toFixed(2);
}

function addItemToBill(item) {
    let bill = JSON.parse(sessionStorage.getItem('bill')) || [];
    bill.push(item);
    sessionStorage.setItem('bill', JSON.stringify(bill));
    displayBill();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "bill.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send("item=" + encodeURIComponent(item.name) + "&quantity=" + item.quantity + "&rate=" + item.rate);
}

function removeRow(element) {
    let row = element.parentNode.parentNode;
    let itemName = row.querySelector('span').innerText;
    let bill = JSON.parse(sessionStorage.getItem('bill')) || [];
    bill = bill.filter(item => item.name !== itemName);
    sessionStorage.setItem('bill', JSON.stringify(bill));
    row.parentNode.removeChild(row);
    updateTotal();
}

function updateTotal() {
    let bill = JSON.parse(sessionStorage.getItem('bill')) || [];
    let total = 0;
    bill.forEach(item => {
        total += item.rate * item.quantity;
    });
    document.getElementById('totalPrice').innerText = total.toFixed(2);
}

function checkout(){
    alert("Proceeding to checkout!");
}